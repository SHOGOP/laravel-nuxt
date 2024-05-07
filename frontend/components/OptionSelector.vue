    <template>
    <v-item-group
        mandatory
        v-model="resModel"
      >
    <v-card
    class="bg-red-lighten-4"
    max-width = "150"
    >
    <h3 class="text-center">{{ Props.optionName }}</h3>
  </v-card>
    <v-card
    class="overflow-y-auto bg-red-lighten-4"
    max-width = "900"
        id="scroll-target"
    style="max-height: 300px"
    >
    <v-row
    no-gutters
    >
    <v-col
      :cols="Props.colSize"
      class="align-center justify-center ml-0 mt-0 "
      v-for="(item, index)  in Items"
      :key="index"
      >
    <v-hover v-slot:default="{ isHovering, props }">
    <v-item v-slot="{ isSelected, toggle}" 
    :value="item"
    >
    <v-card
    class="align-center ma-1"
    v-bind="props"
    :color="isSelected ? 'primary' : ''"
    :elevation="isHovering ? 12 : 2"
    dark
    @click="select_option(toggle)"
    max-width = "300"
    >
    <v-img
    class=" align-end ma-1"
      color="#385F73"
      max-width = "300"
      :gradient="isSelected ? 'to bottom, rgba(0,0,0,.0), rgba(0,0,0,.0)' :
      'to bottom, rgba(0,0,0,.0), rgba(0,0,0,.5)' "
      :src="`${imgPrefix}${Props.itemName}/${item}.jpg`"
      v-if="Props.optionName==='option1'"
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
    <v-img
      class=" align-end ma-1"
      color="#385F73"
      width = "95%"
      :gradient="isSelected ? 'to bottom, rgba(0,0,0,.0), rgba(0,0,0,.0)' :
      'to bottom, rgba(0,0,0,.0), rgba(0,0,0,.5)' "
      :src="`/img/${Props.optionName}/${item}/image.jpg`"
      v-else
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
    <div class="card-font-size">{{item}}</div>
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
  colSize: string
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
<style lang="scss" scoped>
.card-font-size {
  font-size: 0.8rem;
  font-weight: bold; 
}
</style>
