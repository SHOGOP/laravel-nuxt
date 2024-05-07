<template>
  <v-container height="300px" 
  max-width="500px"
  class="bg-blue-lighten-3 rounded-lg"
  elevation="3">
 
  <v-row
  no-gutters
  >
    <v-col cols="12" class="ml-2">
      <v-card
        max-width="250"
        >
        <h2 class="ml-2">{{ title }}</h2>
      </v-card>
    </v-col>
    <v-col
      cols="3"
      class="flex-row justify-center ml-2 mt-3"
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
    @click="goToCategoryPage(item.title)"
  >
    <v-img
      class=" align-end"
      color="#385F73"
      max-width="300px"
      height="200px"
      gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
      :src="`${imgPrefix}${Props.rootUrl}${item.title}/image.jpg`"
      :alt="item.title"
    >
        <template v-slot:placeholder>
          <div class="d-flex align-center justify-center fill-height">
            <v-progress-circular
              color="grey-lighten-4"
              indeterminate
            ></v-progress-circular>
           </div>
        </template>
    <v-card-title class="text-h5">{{item.title}}</v-card-title>
    </v-img>

    <v-card-text class="text--primary">
      <div
      class="d-inline"
      v-for="sub in item.subtitle"
      :key="item.id">
      {{ sub }}/</div>

    </v-card-text>
  </v-card>
  </v-hover>
  </v-col>
  </v-row>
  </v-container>
</template>
<script setup lang="ts">

interface Props {
  apiUrl: string
  rootUrl: string
  title:string
}

const Props = defineProps<Props>()
const runtimeConfig = await useRuntimeConfig();
const url = runtimeConfig.public.apiUrl +"/api" + Props.apiUrl
const router = useRouter();
const goToCategoryPage = (id: string) => {
    router.push(Props.rootUrl+id)
}
const imgPrefix = "/img/category"

const response = await fetch(url,{
  method: 'GET',
});
let products = await response.json();

</script>
<style lang="sass" scoped></style>
