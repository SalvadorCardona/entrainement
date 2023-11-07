<template>
  <div
    v-if="currentShowModale"
    class="fixed left-0 top-0 flex h-full w-full items-center justify-center bg-black bg-opacity-50 py-10"
  >
    <div
      class="max-h-full w-full max-w-xl overflow-y-auto sm:rounded-2xl bg-white"
    >
      <div class="w-full">
        <div class="m-8 my-20 max-w-[400px] mx-auto">
          <div class="mb-8">
            <h1 class="mb-4 text-3xl font-extrabold">
              {{ title }}
            </h1>
            <p class="text-gray-600">{{ content }}</p>
          </div>
          <div class="space-y-4">
            <button
              class="p-3 bg-black rounded-full text-white w-full font-semibold"
              @click="close"
            >
              Fermer la modale
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref, watch } from 'vue'

export interface ModaleProps {
  title?: string
  content?: string
  showModal?: boolean
}

const props = defineProps<ModaleProps>()

const currentShowModale = ref<boolean>(props.showModal)

const close = () => {
  currentShowModale.value = false
}

watch(
  () => props.showModal,
  (newValue) => {
    currentShowModale.value = newValue
  },
)
</script>
