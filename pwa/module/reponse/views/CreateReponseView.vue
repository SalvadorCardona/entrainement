<script setup lang="ts">
import getDepot from '~/module/depot/api/getDepot'
import LoaderComponent from '~/module/shared/component/LoaderComponent.vue'
import { getAll, getLabel } from '~/module/reponse/Reponse'
import Button from '~/module/shared/component/ButtonComponent.vue'
import createReponse from '~/module/reponse/api/createReponse'

interface Props {
  id: string
}

const props = defineProps<Props>()
const router = useRouter()
const loading = ref(false)

const depot = computedAsync(async () => {
  const resp = await getDepot(props.id)
  console.log(resp.data)
  return resp.data
}, null)

const titre = ref('')
const description = ref('')
const type = ref(0)

const onSubmit = () => {
  loading.value = true
  createReponse({
    titre: titre.value,
    description: description.value,
    type: type.value,
    depot: depot.value['@id'],
  })
    .then(() => {
      router.push('/')
    })
    .catch((e) => {
      window.alert('Une erreur est survenue')
      loading.value = false
    })
}
</script>

<template>
  <div>
    <div v-if="depot">
      <div class="mb-2">
        <h1 class="text-4xl font-bold">{{ depot.titre }}</h1>
        <p class="text-xl">{{ depot.description }}</p>
      </div>
      <div class="mt-4 px-4 py-2 bg-white rounded-xl">
        <h2 class="text-md font-semibold">Création d'une nouvelle réponse</h2>
        <form class="flex flex-col gap-2" @submit.prevent="onSubmit">
          <input type="text" v-model="titre" placeholder="Titre" />
          <textarea v-model="description" placeholder="Description"></textarea>
          <select v-model="type" placeholder="Priorité">
            <option selected disabled value="0">Type de réponse</option>
            <option v-for="type in getAll()" :value="type" :key="type">
              {{ getLabel(type) }}
            </option>
          </select>
          <Button :disabled="loading">{{
            loading ? 'En cours' : 'Creer'
          }}</Button>
        </form>
      </div>
    </div>
    <div v-else>
      <LoaderComponent></LoaderComponent>
    </div>
  </div>
</template>
