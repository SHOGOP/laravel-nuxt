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
<style lang="scss"></style>
