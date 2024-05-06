<template>
<v-container>
      <v-data-table
      v-model:items-per-page="itemsPerPage"
      :items="products.data"
      items-per-page-text="表示行数"
      class="elevation-1"
    ></v-data-table>
    <v-row>
      <v-col
      cols="6"
      >
    <v-sheet class="w-26 mt-5">
      <v-text-field label="category" density="comfortable" v-model="category"></v-text-field>
      <v-text-field label="subcategory" density="comfortable" v-model="subcategory"></v-text-field>
      <v-text-field label="subsubcategory" density="comfortable" v-model="subsubcategory"></v-text-field>
      <v-text-field label="option1" density="comfortable" v-model="option1"></v-text-field>
      <v-text-field label="option2" density="comfortable" v-model="option2"></v-text-field>
  <v-btn
  class="D-flex"
  @click="postProductData">
    Submit
  </v-btn>
  <v-btn
  class="D-flex ml-10"
  @click="postProductData">
    import
  </v-btn>
  <v-btn
  class="D-flex ml-10"
  @click="exportProductData">
    export
  </v-btn>
  <div>{{postUrl}}</div>
  <input type="file" @change="handleFileUpload" />
  <div>{{ csvData}}</div>
    </v-sheet>
    </v-col>
    </v-row>
</v-container>
</template>
<script setup lang="ts">
import * as csvtojson from 'csvtojson'
import Encoding from 'encoding-japanese';
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

const exportProductData =
  async () => {
    const res = await $fetch(postUrl, {
      method: 'GET',
      //responseType: 'blob'
    });
  const data = json2csv(res.data)
  //const data = JSON.stringify(res.data)
  const blob = new Blob([data],{type:"text/plain"})
  const url = URL.createObjectURL(blob)
    const a = document.createElement('a')
  const today = new Date().toISOString()
  document.body.appendChild(a)
  a.download = today+`_export.csv`
  a.href = url
  a.click()
  a.remove()
  URL.revokeObjectURL(url)
  }

const importProductData =
  async () => {
    const res = await $fetch(postUrl, {
      method: 'GET',
      //responseType: 'blob'
    });
  const data = json2csv(res.data)
  //const data = JSON.stringify(res.data)
  const blob = new Blob([data],{type:"text/plain"})
  const url = URL.createObjectURL(blob)
    const a = document.createElement('a')
  const today = new Date().toISOString()
  document.body.appendChild(a)
  a.download = today+`_export.csv`
  a.href = url
  a.click()
  a.remove()
  URL.revokeObjectURL(url)
  }

function json2csv(input:any) {
    const keys = Object.keys(input[0])
  let text =""
    keys.forEach((e) => {
      text += e
    text += ","
    })
  text = text.slice(0, - 1);
    text += "\n"
  input.forEach((e) => {
      Object.values(e).forEach((val)=>{
      text += val
      text += ","
      })
    text = text.slice(0,- 1);
    text += "\n"
  })
  return text
}
function encodeUTF8(str:string) {
  const encoder = new TextEncoder();
  return encoder.encode(str);
}
const csvData = ref([])

// ファイルアップロード時の処理
const handleFileUpload = (event) => {
  const file = event.target.files[0]

  if (file) {
    const reader = new FileReader()

    reader.onload = async (e) => {
      const content = e.target.result
        const codes = new Uint8Array(e.target.result);
        const encoding = Encoding.detect(codes);
        const unicodeString = Encoding.convert(codes, {
          to: 'UNICODE',
          from: encoding,
          type: 'string',
        });
      // CSVデータをJSONに変換
      const lines = await content.split("\n")
      const keys = lines[0].replace("\r","").split(",")
      lines.shift()
      lines.pop()
      const data = []
      lines.forEach((line) => {
        var cnt = 0
        var res = {}
        keys.forEach((key) => {
          if (key == "id" || key == "created_at" || key == "updated_at") { }
          else {
          res[key] = line.split(",")[cnt].replace(" \r", "")
          if (!isNaN(res[key])) {
            res[key]=Number(res[key])
          }
          }
          cnt += 1
        }
        )
        data.push(res)
      })
      csvData.value = data
      const res = await $fetch(postUrl +"restore", {
        method: 'POST',
        body: JSON.stringify(data),
               headers: {
    'Content-Type': 'application/json'
  },
    });
    }
    reader.readAsText(file, "utf-8")
  }
}
function str2Array(str:any) {
    var array = [],i,il=str.length;
    for(i=0;i<il;i++) array.push(str.charCodeAt(i));
    return array;
}
</script>
