    <template>

    <v-item-group
        mandatory
        v-model="resModel"
      >
    <v-card
    class="bg-red-lighten-4"
    width = "150"
    >
    <h3 class="ml-7">{{ Props.optionName }}</h3>
  </v-card>
    <v-card
    class="mt-1 bg-red-lighten-4 "
    width = "500"
    >
    <v-row>
    <v-col
      cols="3"
      class="align-center justify-center ml-0 mt-2 "
      v-for="(item, index)  in Items"
      :key="index"
      >
    <v-hover v-slot:default="{ isHovering, props }">
    <v-item v-slot="{ isSelected, toggle}" 
    :value="item"
    >
    <v-card
    class="align-center "
    v-bind="props"
    :color="isSelected ? 'primary' : ''"
    :elevation="isHovering ? 12 : 2"
    dark
    @click="select_option(toggle)"
    width = "95%"
    height = "95%"

    >
    <v-img
      class=" align-end"
      color="#385F73"
      :gradient="isSelected ? 'to bottom, rgba(0,0,0,.0), rgba(0,0,0,.0)' :
      'to bottom, rgba(0,0,0,.0), rgba(0,0,0,.5)' "
      :src="`${imgPrefix}${Props.itemName}/${item}.jpg`"
      v-if="Props.optionName==='option1'"
    >
    </v-img>
    <v-img
      class=" align-end"
      color="#385F73"
      :gradient="isSelected ? 'to bottom, rgba(0,0,0,.0), rgba(0,0,0,.0)' :
      'to bottom, rgba(0,0,0,.0), rgba(0,0,0,.5)' "
      :src="`/img/${Props.optionName}/${item}/image.jpg`"
      v-else
    >
    </v-img>
    
    </v-card>
    </v-item>
    </v-hover>
    </v-col>
    </v-row>
    </v-card>
    </v-item-group>
</template>
<script setup lang="ts">

interface Props {
  itemName: string
  optionName: string
  Items: any
  selectOption: string
}
const Props = defineProps<Props>()
const resModel = defineModel()

interface Emits {
  (event: "click"): void;
    
}
const emit = defineEmits<Emits>();

const runtimeConfig = await useRuntimeConfig();

const router = useRouter();

const imgPrefix = "/img/category"
const imgSuffix = ref("")
if (Props.optionName == "option2") {
  imgSuffix.value="/option2"
}

const select_option = (toggle?: () => void) => {
  if (toggle) toggle()
  emit("click");
}


</script>
