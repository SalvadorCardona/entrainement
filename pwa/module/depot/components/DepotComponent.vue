<template>
    <div class="bg-white rounded-xl shadow-sm p-4">
        <DepotLine :label="depot.titre"></DepotLine>
        <DepotLine :label="depot.description"></DepotLine>
        <DepotLine :label="depot.dateCreation"></DepotLine>
        <div
            v-if="depot.reponses?.length"
            class="my-4 p-2 border border-gray rounded-xl bg-gray-100 flex flex-col gap-2"
        >
            <div
                v-for="reponse in depot.reponses"
                :key="reponse.titre"
                class="border border-dashed border-2 bg-white px-4 py-2"
            >
                <Reponse
                    :reponse="reponse"
                    :on-check="onCheck"
                    :is-check="isChecked(reponse['@id'])"
                />
            </div>
        </div>
        <div v-else class="flex items-center justify-center">
            <p class="text-base font-semibold">Aucune réponse</p>
        </div>
        <div
            v-if="creerReponseValidation.reponses.length"
            class="max-w-md mx-auto bg-white rounded-md shadow-md p-6"
        >
            <CreerReponseValidationFormComponent
                :on-submit="onSubmit"
            ></CreerReponseValidationFormComponent>
            {{ depot.description }}{{ depot.dateCreation }}
        </div>
        <Button
            @click="
                router.push({ name: 'depots-id', params: { id: depot.id } })
            "
            label="Répondre à la demande"
        />
    </div>
</template>

<script lang="ts" setup>
import { type DepotRead } from '../api/getDepots'
import {
    createReponseValidationRead,
    type ValidationCreate,
} from '~/module/validation/ReponseValidation'
import Button from '~/module/shared/component/ButtonComponent.vue'
import DepotLine from '~/module/depot/components/DepotLine.vue'
import Reponse from '~/module/reponse/component/Reponse.vue'
import CreerReponseValidationFormComponent from '~/module/validation/component/CreerReponseValidationFormComponent.vue'

interface Props {
    depot: DepotRead
    onCreateReponseValidation: (reponseValidation: ValidationCreate) => void
}

const props = defineProps<Props>()

const creerReponseValidation = ref(createReponseValidationRead())

const onCheck = (checked: boolean, idReponse: number | string) => {
    idReponse = idReponse.toString()

    const indexToRemove =
        creerReponseValidation.value.reponses.indexOf(idReponse)
    if (checked && indexToRemove === -1) {
        creerReponseValidation.value.reponses.push(idReponse)
        return
    }

    if (!checked && indexToRemove !== -1) {
        creerReponseValidation.value.reponses.splice(indexToRemove, 1)
    }
}

const isChecked = (idReponse: number | string) => {
    idReponse = idReponse.toString()
    return creerReponseValidation.value.reponses.includes(idReponse)
}

const onSubmit = (description: string) => {
    creerReponseValidation.value.description = description
    props.onCreateReponseValidation(creerReponseValidation.value)
    creerReponseValidation.value.reponses = []
}

const router = useRouter()
</script>
