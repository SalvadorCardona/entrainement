import { Fetcher, type ApiResponse } from 'openapi-typescript-fetch'
import { type components, type operations, type paths } from '~/api-schema/app-api-schema'
import config from "~/module/shared/config";

export type ApiSchemas = components['schemas']

const apiClient = Fetcher.for<paths>()

const headers = {
  accept: 'application/json',
  'Content-Type': 'application/json',
}

apiClient.configure({
  baseUrl: config.apiUrl,
  init: {
    headers,
  },
  use: [], // middlewares
})

export default apiClient
