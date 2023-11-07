<template>
  <div>
    <div class="mb-2">
      <h1 class="title">Bienvenue sur ma belle application</h1>
      <p class="text-xl">Listing des demandes cliniques</p>
    </div>
    <div v-if="depots" class="flex gap-2 flex-col w-full">
      <div
        v-for="depot in depots"
        :key="depot.titre"
        class="bg-white rounded-xl shadow-sm p-4"
      >
        <DepotComponent
          :depot="depot"
          :on-create-reponse-validation="onCreateReponseValidation"
        />
      </div>
    </div>
    <Modale :content="modale.content" :show-modal="modale.showModal" />
  </div>
</template>

<script lang="ts" setup>
import getDepots from '../api/getDepots'
import DepotComponent from '~/module/depot/components/DepotComponent.vue'
import type {ModaleProps} from '~/module/shared/component/ModalComponent.vue'
import Modale from '~/module/shared/component/ModalComponent.vue'
import {postReponseValidation} from '~/module/validation/api/postReponseValidation'
import {type ValidationCreate} from '~/module/validation/ReponseValidation'

const depots = computedAsync(async () =>  {
  const response = await getDepots()
  return response.data['hydra:member']
}, null)

const modale = ref<ModaleProps>({
  content: '', showModal: false,
})

const onCreateReponseValidation = (
  reponseValidation: ValidationCreate,
) => {
  modale.value.showModal = true
  postReponseValidation(reponseValidation)
    .then(() => {
      modale.value.content = 'Votre demande a bien été pris en compte'
      getDepots().then(e => depots.value = e.data["hydra:member"])
    })
    .catch(() => {
      modale.value.content = 'Votre demande a échoué'
      modale.value.showModal = false
    })
}
</script>

<style scoped lang="postcss">
.title {
  @apply text-4xl font-bold;
}
</style>
