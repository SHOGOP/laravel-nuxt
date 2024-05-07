<template>
  <v-row class="d-flex align-center justify-center fill-height">
    <v-col
    cols="9"
    >
    <v-card
    class="mx-auto"
    max-width = "100%"
    v-for="(product,index) in products"
    >
    <v-row>
    <v-col
    cols="2"
    >

    <v-img
      class ="ml-5"
      color="#385F73"
      width="50%"
      :src='"/img/category/" + product.category + "/"
        + product.subcategory + "/" + product.subsubcategory + "/" + product.option1 + "_" + product.option2 + ".jpg"'
    >
        <template v-slot:placeholder>
          <div class="d-flex align-center justify-center fill-height">
            <v-progress-circular
              color="grey-lighten-4"
              indeterminate
            ></v-progress-circular>
           </div>
        </template>
    </v-img>
    </v-col>
    <v-col cols="5" v-if="product.combo==1">
    <h3 class="text-left">{{ product.subsubcategory }} 
      {{ product.option1 }} {{ product.option2 }}</h3>
    <div class="d-flex align-end" >
    販売価格：
    <h3>¥{{ product.price.toLocaleString() }}</h3>
    +税
    ( 税込 ¥{{ calc_tax(product.price).toLocaleString() }} )
    </div>
    </v-col>
    <v-col cols="5" v-else>
    <h3 class="text-left">{{ product.subsubcategory }} 
      {{ product.option1 }} {{ product.option2 }} {{ product.combo }}枚セット</h3>
    <div class="d-flex align-end" >
    販売価格：
    <h3>¥{{ product.price.toLocaleString() }}</h3>
    +税
    ( 税込 ¥{{ calc_tax(product.price).toLocaleString() }} )
    </div>
    </v-col>
    <v-col cols =2>
      <br>
    <v-select :items="qtySelectList" 
      variant="outlined"
      density="compact"
      hide-details
      label="数量" class="ma-2" 
      v-model="qtyList[index]"
      @update:menu="select_qty(index)"
      ></v-select>
      </v-col>
    <v-col>
      <br>
    <div class="d-flex align-end" >
    金額：
    <h2>¥{{ (product.price*qtyList[index]).toLocaleString() }}</h2>
    +税
    </div>
    <div class="d-flex align-end" >
    ( 税込 ¥{{ (calc_tax(product.price)*qtyList[index]).toLocaleString() }} )
    </div>
    </v-col>
    <v-col
    cols="1"
    >
    <br>
      <v-btn
      class="d-flex align-center justify-center "
      color="red"
      @click="deleteCart(index)"
      >
        削除
      </v-btn>
    </v-col>
    </v-row>
    </v-card>
    <v-card
    class="mx-auto mt-2"
    max-width = "100%"
    >
    <v-row>
    <v-col cols="12" v-if="products.length==0">
        <h2 class="text-center">カートに入っている商品はありません</h2>
    </v-col>
    <v-col cols="8" v-else-if="totalFee<5000">
      <div class="d-flex align-center justify-center">
        <h2>◆あと</h2>
        <h2 class="text-red">¥{{ 5000-totalFee }} + 税</h2>
        <h2 class="text-center">のご注文で送料無料になります◆</h2>
      </div>
      <h3 class="text-center">(送料無料商品が含まれる場合は、上記に関係なく送料無料となります)</h3>
    </v-col>
    <v-col cols="8" v-else>
      <br>
      <div class="d-flex align-center justify-center">
        <h2>合計金額が</h2>
        <h2 class="text-red"> ¥5000円 + 税</h2>
        <h2> を超えたので送料が</h2>
        <h2 class="text-red">無料</h2>
        <h2> になりました</h2>
      </div>
    </v-col>
    <v-col cols="4" v-if="products.length==0"></v-col>
    <v-col cols="4" v-else>
    <div class="text-center">
    <h2 >合計金額:¥{{ totalFee.toLocaleString() }}+税</h2>
    <h2 >( 税込 ¥{{ totalFeeTax.toLocaleString() }})</h2>
    </div>
    </v-col>
    </v-row>
  </v-card>
  <v-row>
  <v-col cols="8">
  </v-col>
    <v-col
    cols="4"
    class="mx-auto mt-2"
    >
  <v-btn
  class = "text-white text-h5"
  height="50"
  color="orange-darken-3"
  @click="router.go(-1)"
  >
    買い物を続ける
  </v-btn>
  <v-btn
  class = "text-white text-h5 ml-12"
  height="50"
  color="orange-darken-3"
  >
    購入手続き
  </v-btn>
  </v-col>
  
  </v-row>
    </v-col>
  </v-row>
</template>
<script setup lang="ts">
import anime from 'animejs'
interface Props {

}
//グローバル管理
const userCart = useUserCart();
const { updateCart,removeCart } = userCart;
const Global = useGlobalSetting();
const { calc_tax } = Global;

const router = useRouter();
const resModel = defineModel()

const Props = defineProps<Props>()

const runtimeConfig = await useRuntimeConfig();
const url = runtimeConfig.public.apiUrl + "/api" + '/products/pull'
const idList = userCart.idList
const qtyList =userCart.qtyList
const param = {
  "idList":userCart.idList
}
const response = await fetch(url,{
  method: 'POST',
  body: JSON.stringify(param),
               headers: {
    'Content-Type': 'application/json'
  },
});
let res = await response.json();
let products = ref(res.data)

const qtySelectList =[]
for (let i = 1; i < 50; ++i) {
  qtySelectList.push(i);
}
const totalFee = ref(0)
const totalFeeTax = ref(0)
const select_qty  = (index:number):void => {
  updateCart(index, qtyList[index])
  updateFee()
}

function deleteCart(index:number) {
  removeCart(index);
  products.value.splice(index, 1);
  updateFee()
}
function updateFee() {
  let totalFee_anim = 0
  let totalFeeTax_anim = 0
  for (let i = 0; i < idList.length; i++){
  totalFee_anim += products.value[i].price*userCart.qtyList[i]
  totalFeeTax_anim += calc_tax(products.value[i].price)*userCart.qtyList[i]
  }
    anime({
    targets: totalFee,
    value: totalFee_anim,// 対象を指定
    round: 1,
    duration: 700, // ミリ秒指定
    easing: 'easeInOutCubic' // 加減速の種類
    })
    anime({
    targets: totalFeeTax,
    value: totalFeeTax_anim,// 対象を指定
    round: 1,
    duration: 700, // ミリ秒指定
    easing: 'easeInOutCubic' // 加減速の種類
    })
}
updateFee()//初回実行
</script>
