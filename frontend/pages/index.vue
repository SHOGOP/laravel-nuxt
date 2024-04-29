<template>
  <h1>Index</h1>
  <ItemCards :apiUrl="'/category'" :rootUrl="'/'" />
</template>
<script setup lang="ts">
const route = useRoute();
</script>
<style lang="sass" scoped>
</style>
