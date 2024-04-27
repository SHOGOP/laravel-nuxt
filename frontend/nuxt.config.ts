// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,
  modules: [
    '@invictus.codes/nuxt-vuetify',
    ['@nuxtjs/eslint-module', { lintOnStart: false }],

  ],
      runtimeConfig: {
        apiKey: '',
        public: {
            apiUrl: '',
        }
    },
});
