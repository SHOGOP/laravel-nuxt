// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  modules: [
    '@invictus.codes/nuxt-vuetify',
    ['@nuxtjs/eslint-module', { lintOnStart: false }],
    '@nuxtjs/axios',
    '@nuxtjs/proxy'
  ],
  axios: { proxy: true },
proxy: {
  '/api': 'http://127.0.0.1:8000',
},
});
