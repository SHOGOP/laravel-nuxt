<template>
  <ItemCards :apiUrl="apiUrl" :rootUrl="rootUrl" />
</template>

<script setup lang="ts">

const router = useRoute();
const apiUrl = '/subcategory/'+router.params.subcategory
const rootUrl = "/"+router.params.category_dir+"/"+router.params.subcategory+"/"
</script>
