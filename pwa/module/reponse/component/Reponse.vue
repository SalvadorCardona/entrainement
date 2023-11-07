<script lang="ts" setup>
import { getLabel, type ReponseRead } from '~/module/reponse/Reponse'

const getTypeLabel = getLabel
interface ReponseProps {
  reponse: ReponseRead
  onCheck: (checked: boolean, idReponse: number) => void
  isCheck: boolean
}

const props = defineProps<ReponseProps>()

const hasValidation = (reponse: ReponseRead) => !!reponse.validation
const onCheckboxChange = function (e: Event) {
  props.onCheck((e.target as HTMLInputElement).checked, props.reponse['@id'])
}
</script>

<template>
  <div class="reponse">
    <p class="text-red-500">
      Type: <span>{{ getTypeLabel(reponse.type) }}</span>
    </p>
    <p>
      Titre: <span>{{ reponse.titre }}</span>
    </p>
    <p>
      Description: <span>{{ reponse.description }}</span>
    </p>
    <p>
      Date de création: <span>{{ reponse.dateCreation }}</span>
    </p>
    <p>
      Validé le:
      <span v-if="hasValidation(reponse)">{{
        reponse.validation?.dateCreation
      }}</span>
      <span v-else>Non validé</span>
    </p>
    <p v-if="hasValidation(reponse)">
      Message de validation:
      <span>{{ reponse.validation?.description }}</span>
    </p>
    <div
      v-if="!hasValidation(reponse)"
      class="flex justify-end items-center cursor-pointer"
    >
      <label :for="reponse.id + 'validation-checkbox'" class="mr-2 mt-10"
        >Selectionner</label
      >
      <input
        :id="reponse.id + 'validation-checkbox'"
        type="checkbox"
        @change="onCheckboxChange"
        :value="isCheck"
      />
    </div>
  </div>
</template>

<style scoped>
.reponse {
  @apply border border-dashed border-2 bg-white px-4 py-2;
}

.reponse > p {
  @apply text-base font-semibold;
}

.reponse > p > span {
  @apply text-base text-gray-700 font-light;
}
</style>
