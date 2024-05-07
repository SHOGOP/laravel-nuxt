<template>
  <v-container
  fluid
  height="1500px" 
  class="bg-blue-lighten-3 rounded-lg "
  elevation="3"
  >
  <CartDetailCard />


  </v-container>

</template>
<script setup lang="ts">
const runtimeConfig = await useRuntimeConfig();
const url = runtimeConfig.public.apiUrl + "/api" + '/products/pull'
//グローバル管理
const userCart = useUserCart();
const { resetCart } = userCart;
const Global = useGlobalSetting();
const { calc_tax } = Global;

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
let products = await response.json();

const totalFee = ref(0)
const totalFeeTax = ref(0)
for (let i = 0; i < idList.length; i++){
  totalFee.value += products.data[i].price*userCart.qtyList[i]
  totalFeeTax.value += calc_tax(products.data[i].price)*userCart.qtyList[i]
}

</script>
