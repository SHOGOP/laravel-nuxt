<template>
  <ItemDetail :itemName="apiUrl" :rootUrl="rootUrl" />
</template>

<script setup lang="ts">

const router = useRoute();
const apiUrl = router.params.detail
const rootUrl = "/" + router.params.category_dir +
  "/" + router.params.subcategory_dir +
  "/" + router.params.detail
</script>
