<template>
  <div class="flex justify-center items-center">
    <div
      class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-purple-500"
    ></div>
  </div>
</template>

<script lang="ts" setup>
defineProps({
  fullPage: {
    default: false,
    required: false,
    type: Boolean,
  },
})
</script>

<style scoped>
.content {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-content: center;
}

.content.loader-fixed {
  align-items: center;
  background: rgba(255, 255, 255, 0.8);
  display: inline-flex;
  height: 100%;
  justify-content: center;
  left: 0;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 999;
}

.content .donut-spinner {
  animation: donut-spin 1.2s linear infinite;
  border: 4px solid hsl(222, 100%, 95%);
  border-radius: 50%;
  display: inline-block;
  height: 30px;
  width: 30px;
}

@keyframes donut-spin {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}
</style>
