<script setup lang="ts">
import Button from '~/module/shared/component/ButtonComponent.vue'

interface Props {
  onSubmit: (content: string) => void
}

defineProps<Props>()

const description = ref('')
</script>

<template>
  <form @submit.prevent="(e) => onSubmit(description)">
    <div class="mb-4">
      <label for="message"> >Message:</label>
      <textarea
        v-model="description"
        id="message"
        name="message"
        rows="4"
        maxlength="255"
        required
      />
    </div>
    <div class="text-center">
      <Button label="Envoyer votre validation" type="submit" />
    </div>
  </form>
</template>
