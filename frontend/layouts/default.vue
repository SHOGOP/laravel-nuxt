<template>
  <v-app>
    <DefaultHeader />
    <DefaultSideNav />
    <v-main class="d-flex align-center">
      <v-container>
        <slot />
      </v-container>
    </v-main>
    <DefaultFooter />
  </v-app>
</template>
<script setup lang="ts"></script>
<style lang="scss">
.page-enter-active,
.page-leave-active {
  transition: opacity 2s;
}
.page-enter,
.page-leave-active {
  opacity: 0;
}
</style>
