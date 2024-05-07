<template>
  <v-sheet
  class="mx-auto"
  width="500px"
  >
  <v-carousel
    height="400"
    width="500px"
    show-arrows="hover"
    cycle
  > 
      <v-carousel-item>
        <v-sheet
          height="100%"
          tile
          color="#385F73"
        >
        <v-img
          width="100%"
          :aspect-ratio="1/1"
          src="/img/top/illust.jpg"
          style="object-fit: fill;"
        />
      </v-sheet>
      </v-carousel-item>
      <v-carousel-item>
        <v-sheet
          height="100%"
          tile
          color="#385F73"
        >
        <v-img
          width="100%"
          :aspect-ratio="1/1"
          src="/img/top/printtitle.jpg"
          style="object-fit: fill;"
        />
      </v-sheet>
      </v-carousel-item>
      <v-carousel-item>
        <v-sheet
          height="100%"
          tile
          color="#385F73"
        >
        <v-img
          width="100%"
          :aspect-ratio="1/1"
          src="/img/top/easyorder-privacy-top.jpg"
          style="object-fit: fill;"
        />
      </v-sheet>
      </v-carousel-item>
  </v-carousel>
  </v-sheet>
</template>
<script>

const slide_item = ['illust', 'illust']
const images = [
        "https://cdn.vuetifyjs.com/images/cards/docks.jpg",
        "https://cdn.vuetifyjs.com/images/cards/hotel.jpg",
        "https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
      ]
</script>
