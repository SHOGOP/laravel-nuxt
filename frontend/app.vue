<template>
  <NuxtLayout>
    <NuxtPage />
  </NuxtLayout>
</template>
<script setup lang="ts">
const user = useState<{ id: string, name: string, mail: string,cartCount:number }>('login-user', () => {
  console.log('retrieving user info...')
  return {
    id: '012345',
    name: 'mamezou',
    mail: 'nuxt-developer@mamezou.com',
    cartCount:0
  };
})

</script>
<style >
</style>
