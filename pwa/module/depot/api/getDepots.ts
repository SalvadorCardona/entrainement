import clientHttp, { type ApiSchemas } from '~/module/shared/clientHttp'

export type DepotRead = ApiSchemas['Depot.jsonld-depot.read']

export default function getDepots() {
  return clientHttp.path('/depots').method('get').create()({})
}
