<template>
  <div>
    <h3>TEST</h3>
    <p>{{products.data}}</p>
  </div>
</template>

<script setup lang="ts">

const runtimeConfig = await useRuntimeConfig();
const url = runtimeConfig.public.apiUrl + '/api/products'

const response = await fetch(url,{
  method: 'GET',
});
let products = await response.json();
</script>

