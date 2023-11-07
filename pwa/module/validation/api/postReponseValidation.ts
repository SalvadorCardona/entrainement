import { type ValidationCreate } from '~/module/validation/ReponseValidation'
import clientHttp from '~/module/shared/clientHttp'

export function postReponseValidation(
  reponseValidation: ValidationCreate,
) {
  return clientHttp.path('/validations').method('post').create()(
    reponseValidation,
  )
}

