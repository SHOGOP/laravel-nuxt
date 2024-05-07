    <template>
  <v-card
  >
  
  <v-row
  no-gutters
  >
<!-- 商品説明 -->
  <v-col cols =9>
  <v-row no-gutters>
  <v-col cols =12>
    <h2>{{ item.subsubcategory }} {{ item.option1 }} {{ item.option2 }}</h2> 
  </v-col>

  <v-col cols =12>
    <v-row>
      <v-col cols =4>PDA工房</v-col>
      <v-col cols =4>-</v-col>
      <v-col cols =4>在庫状況：○</v-col>
    </v-row>
  </v-col>

  <v-col cols =12>
    <h3>指紋や皮脂汚れがつきにくい非光沢タイプ保護フィルム！</h3>
  </v-col>

  <v-col cols =12>
    <div class="text-red text-center"><代引以外ならポスト投函便送料無料></div>
  </v-col>  
  </v-row>
  </v-col>
<!-- セット選択 -->
  <v-col cols =3>
    <v-row no-gutters class="text-end">
      <v-col cols =6>
        <h3 class = "mt-4">セット：</h3>
      </v-col>
      <v-col cols =6>
      <v-select :items="Items" 
        variant="outlined"
        density="compact"
        hide-details
        label="Set" class="ma-2" 
        v-model="resModel"
        @update:menu="select_combo()"
        ></v-select>
      </v-col>

    </v-row>
<!-- 数量選択 -->
    <v-row no-gutters class="text-end">
      <v-col cols =6>
      <h3 class = "mt-4">数量： </h3>
      </v-col>
      <v-col cols =6>
        <v-select :items="qtyList" 
          variant="outlined"
          density="compact"
          hide-details
          label="Qty" class="ma-2"
          v-model="selectQty"
          @update:menu="select_qty()"
        ></v-select>
      </v-col>
    </v-row>
  </v-col>
  <v-divider thickness="2"></v-divider>
  <v-col cols =12>
    <v-row>
    <v-col cols =3 >
    <div class="d-flex align-end" >
    <br>
    販売価格：
    <h3>¥{{ price.toLocaleString() }}</h3>
    +税
    </div>
    <div class="d-flex align-end">
    ( 税込 ¥{{ priceTax.toLocaleString() }} )
    </div>
    </v-col>
    <v-col cols =6 class="d-flex align-end">
        <h3>金額:</h3>
        <h1>¥{{ totalFee.toLocaleString() }}円</h1>
    <div class="d-flex align-end">
    (税込 ¥{{ totalFeeTax.toLocaleString() }})
    </div>
    </v-col>
      <v-col cols =3>
  <v-container class="text-end">
  <v-btn
    class = "text-white"
    height="50"
    color="orange-darken-3"
    @click="click_addCart(item.id,selectQty)"
    >
    <template v-slot:prepend>
      <v-icon 
      icon="mdi-cart"
      size="x-large"
      color="white"></v-icon>
      <h1>購入する</h1>
    </template>
   </v-btn>
  </v-container>
      </v-col>
  </v-row>
  </v-col>
  </v-row>
    </v-card>

</template>
<script setup lang="ts">

interface Props {
  item:object
  price: number
  priceTax: number
  totalFee: number
  totalFeeTax: number
  Items: any
}
const Props = defineProps<Props>()
const resModel = defineModel()
//const selectCombo = ref(1)
const qtyList = <number[]>[]
const selectQty = ref(1)
for (let i = 1; i < 50; ++i) {
  qtyList.push(i);
}
interface Emits {
  (event: "update"): void;
  (event: "comboUpdate"): void;
  (event: "qtyUpdate", selectQty: number): string;
}
const emit = defineEmits<Emits>();
const runtimeConfig = await useRuntimeConfig();

const router = useRouter();
const tst = ref("test")
const select_combo = ():void => {
  emit("comboUpdate");
}

const select_qty  = ():void => {
  emit("qtyUpdate", selectQty.value);
}

const userCart = useUserCart();
const { addCart } = userCart;
const goToCartPage = () => {
    router.push("/cart")
}
function click_addCart(id:string,qty:number) {
  addCart(id,qty)
  goToCartPage()
}
</script>
