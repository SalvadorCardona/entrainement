// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  css: ['~/main.css'],
  devtools: { enabled: true },
  modules: ['@nuxtjs/tailwindcss', '@nuxtjs/eslint-module', '@vueuse/nuxt'],
  postcss: {
    plugins: {
      tailwindcss: {
        config: '~/tailwind.config.cjs',
      },
      autoprefixer: {},
    },
  },
})
