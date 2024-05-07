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
<!-- ItemDescription -->
    <v-col
      cols="2"
      class="flex-row justify-center ">
    <ItemDescription :itemName="Props.itemName" 
    :rootUrl="Props.rootUrl"
    :option1="option1"
    :option2="option2"
    />
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
<!-- Cart -->
    <v-col
      cols="12"
      >
    <ItemDetailCart :item="product"
    :price="price"
    :priceTax="priceTax"
    :totalFee="totalFee"
    :totalFeeTax="totalFeeTax"
    :Items="products_combo"
    v-model="combo"
    v-on:comboUpdate="onComboClick"
    v-on:qtyUpdate="onQtyClick"
    />
    </v-col>
    </v-col>
    </v-row>
    
  </v-container>
</template>
<script setup lang="ts">
import { useGoTo } from 'vuetify'
import alasql from 'alasql';
import anime from 'animejs'
interface Props {
  itemName: string
  rootUrl: string
}

const Props = defineProps<Props>()
const runtimeConfig = await useRuntimeConfig();
const productName = Props.itemName
const url = runtimeConfig.public.apiUrl + "/api"+'/detail/' + Props.itemName

const router = useRouter();
const goToCategoryPage = (id: string) => {
    router.push(Props.rootUrl+id)
}
const Global = useGlobalSetting();
const { calc_tax } = Global;
const imgPrefix = "/img/category"

const response = await fetch(url,{
  method: 'GET',
});
let products = await response.json();

const option1 = ref(products.data[0].option1)
const option2 = ref(products.data[0].option2)
const combo = ref(products.data[0].combo)
const qty = ref(1)

const price = ref(products.data[0].price)
const priceTax = ref(calc_tax(products.data[0].price))
const totalFee = ref(products.data[0].price)
const totalFeeTax = ref(calc_tax(products.data[0].price))
const product = ref()
const products_op1 = ref<string[]>([])
const products_op2 = ref<string[]>([])
const products_combo = ref<number[]>([])
const test = ref<string[]>([])

async function set_products() {
  //配列初期化
  products_op1.value = []
  products_op2.value = []
  products_combo.value = []
  //option1 sql
  var sql = 'SELECT DISTINCT option1 ' +
    'FROM ? dt ';
  var rs = alasql(sql, [products.data]);
  var res = []
  rs.forEach((e) => { res.push(e["option1"]) })
  products_op1.value = res
  //option2 sql
  var sql = 'SELECT DISTINCT option2 ' +
    'FROM ? dt ' +
    'WHERE option1 = "' + option1.value + '"';
  var rs = alasql(sql, [products.data]);
  var res = []
  rs.forEach((e) => { res.push(e["option2"]) })
  products_op2.value = res

  var op2_sql = option2.value
  //option2がリストにない場合
  if (!products_op2.value.includes(option2.value)) {
    op2_sql = products_op2.value[0]
    option2.value = op2_sql
  }
  //combo sql
  var sql = 'SELECT DISTINCT combo ' +
    'FROM ? dt ' +
    'WHERE option1 = "' + option1.value + '"' +
    'AND option2 = "' + op2_sql + '"';
  var rs = alasql(sql, [products.data]);
  var res = []
  rs.forEach((e) => { res.push(e["combo"]) })

  products_combo.value = res

  var combo_sql = combo.value
  //comboがリストにない場合
  if (!products_combo.value.includes(combo.value)) {
    combo_sql = 1
    combo.value = combo_sql
  }
  //id sql
  var sql = 'SELECT * ' +
    'FROM ? dt ' +
    'WHERE option1 = "' + option1.value + '"' +
    'AND option2 = "' + op2_sql + '"' +
    'AND combo = ' + combo_sql;
  var rs = alasql(sql, [products.data]);
  test.value = rs
  product.value = rs[0]
  //price sql
  var sql = 'SELECT price ' +
    'FROM ? dt ' +
    'WHERE id = ' + product.value.id;
  var rs = alasql(sql, [products.data]);
  anime({
    targets: price,
    value: rs[0]["price"],// 対象を指定
    round: 1,
    duration: 700, // ミリ秒指定
    easing: 'easeInOutCubic' // 加減速の種類
  })
  anime({
    targets: priceTax,
    value: calc_tax(rs[0]["price"]),// 対象を指定
    round: 1,
    duration: 700, // ミリ秒指定
    easing: 'easeInOutCubic' // 加減速の種類
  })
  const multi = qty.value
    anime({
    targets: totalFee,
    value: rs[0]["price"]*multi,// 対象を指定
    round: 1,
    duration: 700, // ミリ秒指定
    easing: 'easeInOutCubic' // 加減速の種類
    })
    anime({
    targets: totalFeeTax,
    value: calc_tax(rs[0]["price"]*multi),// 対象を指定
    round: 1,
    duration: 700, // ミリ秒指定
    easing: 'easeInOutCubic' // 加減速の種類
    })

}
const goTo = useGoTo();
function onScroll() {
      goTo(0, { container: "scroll-target"});
    }
set_products()
const onOption1Click = ():void => {
  //option1.value = res
  set_products()
  onScroll()
}
const onOption2Click = ():void => {
  set_products()
  onScroll()
}
const onComboClick = (): void => {
  set_products()
  onScroll()
}
const onQtyClick = (select: number): void => {
  qty.value=select
  set_products()
  onScroll()
}


</script>
<style scoped>
</style>
