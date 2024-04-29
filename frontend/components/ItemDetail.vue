<template>
  <div>{{products}}</div>
  <v-container height="1500px" 
  max-width="1500"
  class="bg-blue-lighten-3 rounded-lg "
  elevation="3"
  >
  <v-row>
    <v-col
      cols="5"
      class="flex-row justify-center">
    <v-img
      class=" align-end ml-5"
      color="#385F73"
      max-width="500px"
      height="500px"
      gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
      :src="`${imgPrefix}${Props.rootUrl}/image.jpg`"
    >
    </v-img>
    </v-col>
        <v-col
      cols="5"
      class="flex-row justify-center">
      <v-row>
        <v-col
      cols="5"
      class="flex-row justify-center">
    <v-img
      class=" align-end ml-5"
      color="#385F73"
      max-width="500px"
      max-height="500px"
      gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
      :src="`${imgPrefix}${Props.rootUrl}/image.jpg`"
    >
    </v-img>
    </v-col>
        <v-col
      cols="5"
      class="flex-row justify-center">
    <v-img
      class=" align-end ml-5"
      color="#385F73"
      max-width="500px"
      max-height="500px"
      gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
      :src="`${imgPrefix}${Props.rootUrl}/image.jpg`"
    >
    </v-img>
    </v-col>
    </v-row>
    </v-col>
    </v-row>
  </v-container>
  
</template>
<script setup lang="ts">

interface Props {
  apiUrl: string
  rootUrl: string
}

const Props = defineProps<Props>()
const runtimeConfig = await useRuntimeConfig();

const url = runtimeConfig.public.apiUrl + "/api" + Props.apiUrl

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
