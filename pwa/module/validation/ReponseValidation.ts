import { type ApiSchemas } from '~/module/shared/clientHttp'

export type ValidationCreate =
  ApiSchemas['Validation.jsonld-reponse_validation.create']

export function createReponseValidationRead(): Required<ValidationCreate> {
  return {
    reponses: [],
    description: '',
  }
}
