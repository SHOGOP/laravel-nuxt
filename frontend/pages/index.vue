<template>
  <TopReccomend/>
  <ItemCards :apiUrl="'/category'" :rootUrl="'/'" title="カテゴリーから選ぶ" />
</template>
<script setup lang="ts">
const route = useRoute();
</script>
<style >

</style>
