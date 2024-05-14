<template>
  <div class="d-flex">
  <NuxtLink to="/" >Home</NuxtLink>
  /{{router.params.category}}
  </div>
  <ItemCards :apiUrl="apiUrl" :rootUrl="rootUrl" />
</template>

<script setup lang="ts">

const router = useRoute();
const apiUrl = '/category/'+router.params.category
const rootUrl = "/" + router.params.category + "/"


</script>
