import clientHttp, { ApiSchemas } from '~/module/shared/clientHttp'

export type ReponseCreate = ApiSchemas['Reponse.jsonld-reponse.create']

export default function createReponse(reponseCreate: ReponseCreate) {
  return clientHttp.path('/reponses').method('post').create()(reponseCreate)
}
