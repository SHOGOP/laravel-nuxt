<template>
  <v-card>
    <v-navigation-drawer
      v-model="drawer"
      :rail="rail"
      permanent
      @click="rail = false">
      <v-list-item
        prepend-avatar="https://randomuser.me/api/portraits/men/85.jpg"
        title="John Leider"
        nav>
        <template #append>
          <v-btn
            variant="text"
            icon="mdi-chevron-left"
            @click.stop="rail = !rail"></v-btn>
        </template>
      </v-list-item>

      <v-divider></v-divider>

      <v-list density="compact" nav>
        <v-list-item
          prepend-icon="mdi-home-city"
          title="Home"
          value="home"
          @click="goToHomePage"
          ></v-list-item>
        <v-list-item
          prepend-icon="mdi-account"
          title="Manage"
          value="account"
          @click="goToManagePage"
          ></v-list-item>
        <v-list-item
          prepend-icon="mdi-account-group-outline"
          title="Users"
          value="users"></v-list-item>
      </v-list>
    </v-navigation-drawer>
  </v-card>
</template>
<script setup lang="ts">
import { ref } from 'vue'

const drawer = ref<boolean>(true)
const rail = ref<boolean>(true)
const router = useRouter();
const goToHomePage = () => {
    router.push("/")
}
const goToManagePage = () => {
    router.push("/manage")
}
</script>
<style lang="scss"></style>
