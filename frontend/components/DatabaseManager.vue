<template>
<v-container>
      <v-data-table
      v-model:items-per-page="itemsPerPage"
      :items="products.data"
      items-per-page-text="表示行数"
      class="elevation-1"
    ></v-data-table>
    <v-sheet class="w-25 mt-5">
      <v-text-field label="category" density="comfortable" v-model="category"></v-text-field>
      <v-text-field label="subcategory" density="comfortable" v-model="subcategory"></v-text-field>
      <v-text-field label="subsubcategory" density="comfortable" v-model="subsubcategory"></v-text-field>
      <v-text-field label="option1" density="comfortable" v-model="option1"></v-text-field>
      <v-text-field label="option2" density="comfortable" v-model="option2"></v-text-field>
        <v-btn @click="postProductData">
    Submit
  </v-btn>
    </v-sheet>
  <div>{{postUrl}}</div>
</v-container>
</template>
<script setup lang="ts">
const route = useRoute();

//フィールド用
const category = ref("")
const subcategory = ref("")
const subsubcategory = ref("")
const option1 = ref("")
const option2 =ref("")

const itemsPerPage= 5
const runtimeConfig = await useRuntimeConfig();
const url = runtimeConfig.public.apiUrl + "/api" + "/products"
const postUrl = runtimeConfig.public.apiUrl + "/api" + "/products/"
const res = ref()
const result = ref()
const postProductData =
  async () => {
  await fetch(postUrl,{
  method: 'POST',
    body: JSON.stringify({
        category: category.value,
        subcategory: subcategory.value,
        subsubcategory: subsubcategory.value,
        option1: option1.value,
        option2: option2.value
     }),
       headers: {
    'Content-Type': 'application/json'
  },
   });
  }
const response = await fetch(url,{
  method: 'GET',
});
let products = await response.json();

</script>
