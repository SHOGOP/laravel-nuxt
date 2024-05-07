
<template>
  <v-app-bar color="primary">
    <template #prepend>
      <v-app-bar-nav-icon />
    </template>

    <v-app-bar-title>
      <v-btn
      @click="goToHomePage"
      >
      <div class="text-h5">PDA工房</div>
      </v-btn>
      </v-app-bar-title>

    <template #append>
        <v-card
        rounded="circle"
        width="40"
        height="40"
        color="orange-darken-3"
        >
        <div class="d-flex align-center justify-center fill-height text-h6">
          {{ userCart.count }}
        </div>
        </v-card>
        <v-btn
        @click="goToCartPage()"
        >
          <v-icon
          size="30"
          >
            mdi-cart
          </v-icon>

          カート
        </v-btn>
        <v-btn>
          <v-icon
          size="30"
          >
            mdi-account
          </v-icon>
          アカウント
        </v-btn>
    </template>
    
  </v-app-bar>
</template>
<script setup lang="ts">
const router = useRouter();
const goToHomePage = () => {
    router.push("/")
}
const goToCartPage = () => {
    router.push("/cart")
}
const userCart = useUserCart();
</script>
<style lang="scss"></style>
