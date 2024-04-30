<template>

  <v-app>
    <DefaultHeader />
    <DefaultSideNav />

    <v-main class="d-flex"
    >
      <v-container fluid>
        <slot />
      </v-container>
    </v-main>
  <v-fab-transition>
    <v-btn
      color="pink"
      fab
      dark
      small
      absolute
      right
      style="bottom:20px; position:fixed;"
      @click="$vuetify.goTo(0)"  
      v-show="buttonActive"
    >
      <v-icon>mdi-chevron-up</v-icon>
    </v-btn>
  </v-fab-transition>
    <DefaultFooter />
  </v-app>
  
</template>
<script setup lang="ts">

const scroll = ref(0)
const buttonActive = ref(false)
const scrollWindow = () => {
      const top = 0
      scroll.value = window.scrollY
          if (top <= scroll.value) { // 200px以上スクロールした場合のみボタンを表示
        buttonActive.value = true
      } else {
        buttonActive.value = false
      }
}
window.addEventListener('scroll', scrollWindow) // スクロールの位置を監視
</script>
<style lang="scss">
.fade-enter-active, .fade-leave-active {
  will-change: opacity;
  transition: opacity 225ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
}
.fade-enter, .fade-leave-to {
  opacity: 0
}
</style>
