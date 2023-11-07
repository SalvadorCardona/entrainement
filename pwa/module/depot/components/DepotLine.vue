<script setup lang="ts">
interface Props {
    label: string|undefined
}

defineProps<Props>()
</script>

<template>
    <p class="text-base font-semibold">
        Titre:
        <span class="text-base text-gray-700 font-light">{{ label }}</span>
    </p>
</template>

