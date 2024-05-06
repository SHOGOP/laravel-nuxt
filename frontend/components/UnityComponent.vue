<script lang="ts" setup>
useProvideNuxtUnity(undefined, (unity) => {
  // eslint-disable-next-line no-console
  console.log(unity)
})
const { NuxtUnity, loaded, SendMessage } = useNuxtUnityOrThrow()
const callUnityFunction = () => {
  // scalar or json object are enable as argument
  SendMessage('GameObject', 'HelloMethod', { message: 'hello' })
}
const nuxtApp = useNuxtApp()

nuxtApp.$nuxtUnityEvent('nuxt-unity:ready').on(({ providerId, unityInstance }) => {
  // eslint-disable-next-line no-console
  console.log(providerId, unityInstance)
})
</script>

<template>
  <div class="container">
    <NuxtUnity
      width="500px"
      height="700px"
      unity-loader="/unity/WebGL.loader.js"
      :config="{
        dataUrl: '/unity/WebGL.data',
        frameworkUrl: '/unity/WebGL.framework.js',
        codeUrl: '/unity/WebGL.wasm',
      }"
      :resizable="true"
      :refresh-delay-time="100"
    ></NuxtUnity>
  </div>
  <button @click="callUnityFunction">SendMessage</button>
</template>
