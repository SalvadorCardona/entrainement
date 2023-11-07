<script lang="ts" setup>
import ChatBoxComponent from "~/module/chat-box/component/ChatBoxComponent.vue";

useHead({
    title: 'Home',
    titleTemplate: `%s - Home Page`,
})
</script>

<template>
    <Body
        class="container mx-auto mt-10 min-h-screen"
    >
    <ChatBoxComponent></ChatBoxComponent>
    <NuxtLayout>
        <NuxtLoadingIndicator />
        <NuxtPage />
    </NuxtLayout>
    </Body>
</template>

<style>
body {
    background-color: #f5f5f5;
}
</style>
