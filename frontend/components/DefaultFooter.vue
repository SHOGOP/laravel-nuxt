<template>
  <v-footer class="d-flex flex-column justify-end pa-0" app>
    <div class="bg-teal d-flex w-100 align-center px-4">
      <strong>Get connected with us on social networks!</strong>

      <v-spacer />

      <v-btn
        v-for="icon in icons"
        :key="icon"
        class="mx-4"
        :icon="icon"
        variant="plain"
        size="small"
        href="https://next.vuetifyjs.com/en/components/buttons/"
        />
    </div>

    <div class="px-4 py-2 bg-black text-center w-100">
      {{ new Date().getFullYear() }} — <strong>Vuetify</strong>
    </div>
  </v-footer>
</template>
<script lang="ts" setup>
import { ref } from 'vue'

const icons = ref<string[]>([
  'mdi-facebook',
  'mdi-twitter',
  'mdi-linkedin',
  'mdi-instagram'
])
</script>
<style lang="scss"></style>
