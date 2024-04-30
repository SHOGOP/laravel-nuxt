<template>

  <v-container
  fluid
  height="1500px" 
  class="bg-blue-lighten-3 rounded-lg "
  elevation="3"
  >
  <v-row
  no-gutters
  >
    <v-col
      cols="2"
      class="flex-row justify-center ">
    <h3 class="flex-row justify-center ml-5">{{Props.itemName}}</h3>
    <v-img
      class=" align-end ml-5"
      color="#385F73"
      max-width="400px"
      max-height="400px"
      :src="`${imgPrefix}${Props.rootUrl}/${option1}_${option2}.jpg`"
    >
    </v-img>
    <v-sheet
    class ="mt-5"
    color="#b22222"
    height="45%" 
    >
    <div class="flex-row justify-center ml-1">
      <h3>対応機種</h3>
    </div>
    <v-card
    color="#fffafa"
    class = "ml-2 mt-2"
    width="95%" 
    >
    <div class="flex-row justify-center ml-1">
    <li>対応機種 : iPhone 15 Pro Max専用の商品です。</li>
    <li>製品内容 : 画面用フィルム1枚・クリーニングワイプ1個</li>
    <li>※この機器は周辺部が曲面となったラウンド仕様のため、保護フィルムを端まで貼ることができません。(表示部分はカバーしています)</li>
    <li>安心の国産素材を使用。日本国内の自社工場で製造し出荷しています。 ★貼り付け失敗交換サービス対象商品★</li>
    </div>
    </v-card>
      </v-sheet>
    </v-col>
<!-- OptionDetail -->
    <v-col
      cols="4"
      class="flex-row justify-center ml-0">
    <v-container>
    <Option2Detail :option2="option2"/>
    </v-container>
    </v-col>

<!-- Options -->
    <v-col
      cols="6"
      class="flex-row justify-center ml-0"
      >
<!-- Option1 -->
    <v-col
      cols="12"
      >
    <OptionSelector :itemName="Props.rootUrl"
    :optionName="'option1'"
    :Items="products_op1"
    :selectOption="option1"
    colSize="2"
    v-model="option1"
    v-on:click="onOption1Click"
    />
    </v-col>
<!-- Option2 -->

    <v-col
      cols="12"
      >
    <OptionSelector :itemName="Props.rootUrl"
    :optionName="'option2'"
    :Items="products_op2"
    :selectOption="option2"
    colSize="3"
    v-model="option2"
    v-on:click="onOption2Click"
    />
    </v-col>
    </v-col>
    </v-row>
  </v-container>
</template>
<script setup lang="ts">
import { useGoTo } from 'vuetify'
interface Props {
  itemName: string
  rootUrl: string
}

const Props = defineProps<Props>()
const runtimeConfig = await useRuntimeConfig();

const url = runtimeConfig.public.apiUrl + "/api"+'/detail/' + Props.itemName

const router = useRouter();
const goToCategoryPage = (id: string) => {
    router.push(Props.rootUrl+id)
}

const imgPrefix = "/img/category"

const response = await fetch(url,{
  method: 'GET',
});
let products = await response.json();

const option1 = ref(products.data[0].option1)
const option2 = ref(products.data[0].option2)
const products_op1 = ref<string[]>([])
const products_op2 = ref<string[]>([])

function set_products() {
  products_op1.value = []
  products_op2.value=[]
  products.data.forEach((e) => {
  products_op1.value.push(e.option1);
  if(e.option1 == option1.value){
    products_op2.value.push(e.option2);
  }
  products_op1.value = products_op1.value.filter((element, index) => {
    return products_op1.value.indexOf(element) == index;
  }) 
  products_op2.value = products_op2.value.filter((element, index) => {
    return products_op2.value.indexOf(element) == index;
  }) 

});
}
const goTo = useGoTo();
function onScroll() {
      goTo(0, { container: "scroll-target"});
    }
set_products()
const onOption1Click = ():void => {
  //option1.value = res
  set_products()
  option2.value = products_op2.value[0]
  onScroll()
}
const onOption2Click = ():void => {
  set_products()
  onScroll()
}

</script>
<style scoped>
</style>
