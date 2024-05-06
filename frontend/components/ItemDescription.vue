<template>
    <h3 class="flex-row justify-center ml-5">{{Props.itemName}}</h3>
    <v-img
      class=" align-end ml-5"
      color="#385F73"
      max-width="400px"
      max-height="400px"
      :src="`${imgPrefix}${Props.rootUrl}/${option1}_${option2}.jpg`"
    >
        <template v-slot:placeholder>
          <div class="d-flex align-center justify-center fill-height">
            <v-progress-circular
              color="grey-lighten-4"
              indeterminate
            ></v-progress-circular>
           </div>
        </template>
    </v-img>

    <v-sheet
    class ="mt-5"
    color="#b22222"
    height="45%" 
    >
    <div class="flex-row justify-center ml-1">
      <h3>対応機種</h3>
    </div>
    <v-card
    color="#fffafa"
    class = "ml-2 mt-2"
    width="95%" 
    >
    <div class="flex-row justify-center ml-1">
    <li>対応機種 : {{Props.itemName}} 専用の商品です。</li>
    <li>製品内容 : 画面用フィルム1枚・クリーニングワイプ1個</li>
    <li>※この機器は周辺部が曲面となったラウンド仕様のため、保護フィルムを端まで貼ることができません。(表示部分はカバーしています)</li>
    <li>安心の国産素材を使用。日本国内の自社工場で製造し出荷しています。 ★貼り付け失敗交換サービス対象商品★</li>
    <li>{{userState.id}} </li>
    </div>
    </v-card>
      </v-sheet>
      
</template>
<script setup lang="ts">
interface Props {
  itemName: string
  rootUrl: string
  option1: string
  option2: string
}

const Props = defineProps<Props>()
const imgPrefix = "/img/category"
const userState = useState('login-user')

</script>
