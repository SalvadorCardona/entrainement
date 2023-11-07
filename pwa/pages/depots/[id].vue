<template>
  <DepotAddView :id="route.params.id"></DepotAddView>
</template>

<script setup lang="ts">
import DepotAddView from '~/module/reponse/views/CreateReponseView.vue'
const route = useRoute()
</script>
