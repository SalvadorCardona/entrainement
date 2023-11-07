import clientHttp from '~/module/shared/clientHttp'

export default function getDepot(id: string) {
  return clientHttp.path('/depots/{id}').method('get').create()({ id })
}
