<script lang="ts" setup>
interface Props {
    label?: string
    onClick?: () => void
    disabled?: boolean
}

const props = defineProps<Props>()
</script>

<template>
    <button
        :disabled="props?.disabled ?? false"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2"
        @click="props.onClick ? props.onClick() : null"
    >
        {{ props?.label }}

        <slot> </slot>
    </button>
</template>
