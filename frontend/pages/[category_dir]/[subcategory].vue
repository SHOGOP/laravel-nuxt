<template>
  <div class="d-flex">
  <NuxtLink to="/" >Home</NuxtLink>
  /
  <NuxtLink :to="link" >{{ router.params.category_dir }}</NuxtLink>
  /
  {{router.params.subcategory}}
  </div>
  <ItemCards :apiUrl="apiUrl" :rootUrl="rootUrl" />
</template>

<script setup lang="ts">

const router = useRoute();
const apiUrl = '/subcategory/'+router.params.subcategory
const rootUrl = "/" + router.params.category_dir + "/" + router.params.subcategory + "/"
const link = "/"+router.params.category_dir
</script>
