// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,
 components: [
   {
     path: '~/components',
     extensions: ['.vue']
   }
 ],
  modules: [
    '@invictus.codes/nuxt-vuetify',
    ['@nuxtjs/eslint-module', { lintOnStart: false }],
    'nuxt-unity-webgl',
    '@pinia/nuxt',
    '@pinia-plugin-persistedstate/nuxt',
  ],
      runtimeConfig: {
        apiKey: '',
        public: {
            apiUrl: '',
        }
    },
});
