<template>

    <v-card
      id="scroll-target"
      class="overflow-y-auto"
      style="max-height: 750px"
      max-width = "600px"
    >

    <v-row
      style="height: 1000px"
    >
  <v-col>

    <v-img
    v-for="n in 5"
    class = "ma-5"
      color="#385F73"
      max-width="90%"
      :src="`${imgPrefix}${Props.option2}/descript_${n}.jpg`"
      :alt="Props.option2"
    >
    </v-img>
  </v-col>
      </v-row>
    </v-card>
</template>
<script setup lang="ts">

interface Props {
  option2: string
}

const Props = defineProps<Props>()
const runtimeConfig = await useRuntimeConfig();

const router = useRouter();

const imgPrefix = "/img/option2/"
const offsetTop = ref()

</script>
<style lang="sass" scoped></style>
