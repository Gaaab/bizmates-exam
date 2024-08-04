import axios, { AxiosInstance, CreateAxiosDefaults } from 'axios'

const defaultHeaders : CreateAxiosDefaults = {
  headers: {
    ContentType: 'application/json',
    Accept: 'application/json',
    // Authorization: `Bearer ${authStore.tokenData.access_token}`,
  },
}

export const HTTP_API = () : AxiosInstance => {
  const instance = axios.create({
    baseURL: import.meta.env.VITE_API_ENDPOINT + '/api',
    ...defaultHeaders,
  })

  const onHandleReject = (error: any): Promise<any> => {
    // Handle http code 400+ errors

    return Promise.reject(error)
  }

  instance.interceptors.response.use(request => request, onHandleReject)

  return instance
}
