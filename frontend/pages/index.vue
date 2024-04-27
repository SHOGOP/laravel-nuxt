<template>
      <v-container height="300px" 
      max-width="500px"
      class="bg-blue-lighten-3 rounded-lg"
      elevation="3">
  <v-row>
    <v-col
      cols="3"
      class="flex-row justify-center"
      v-for="item in products.data"
      :key="item.id">    
          <v-hover
        vv-slot="{ isHovering, props }"
        open-delay="200"
      >
  <v-card
    :class="{ 'on-hover': isHovering }"
    :elevation="isHovering ? 16 : 2"
    class="mx-auto"
    max-width="300"
    v-bind="props"
    @click="goToCategoryPage(item.id)"
  >
    <v-img
      class=" align-end"
      color="#385F73"
      max-width="300px"
      gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
      :src="`/img/category/${item.category}.jpg`"
      :alt="item.name"
    >
    <v-card-title class="text-h5">{{item.category}}</v-card-title>
    </v-img>

    <v-card-text class="text--primary">
      <div>{{ item.category }}</div>

    </v-card-text>
  </v-card>
  </v-hover>
  </v-col>
  </v-row>
  </v-container>
</template>
<script setup lang="ts">
import { ref } from 'vue'
const message = ref("test")

const items = ref([
  {
    id: 1,
    name: 'スマートフォン',
    category: "SmartPhone",
    description: "iPhone/Xperia/Galaxy",
  },
  {
    id: 2,
    name: 'タブレット',
    category: "Tablet",
    description: "iPad/MacBook/Surface",
  },
])

const counter = useState("counter", () => 0);
const router = useRouter();
const goToCategoryPage = (linkID: number) => {
    router.push('/category/'+linkID)
}
//imgのpathを生成する関数
const generateImgPath = (fileName: string): string => {
  return new URL(`../img/category/${fileName}.jpg`, import.meta.url).href
}

const runtimeConfig = await useRuntimeConfig();
const url = runtimeConfig.public.apiUrl + '/api/products'
const response = await fetch(url,{
  method: 'GET',
});
let products = await response.json();
</script>
<style lang="sass" scoped>
.v-card.on-hover.v-theme--dark
  background-color: rgba(#FFF, 0.8)
  >.v-card__text
    color: #000
</style>
