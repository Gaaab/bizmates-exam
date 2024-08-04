import { HTTP_API } from '@/services/http'
import { defineStore } from 'pinia'

export const useMapStore = defineStore('MAP_STORE', () => {
  const cacheVenues = ref<Record<string, any>>([])
  const loading = ref(false)

  const getAutocompleteResults = async (query: string) => {
    const { data } = await HTTP_API().get('venues/autocomplete', {
      params: {
        query,
      },
    })
    return data
  }

  const searchVenuesTrending = async (near: string) => {
    loading.value = true

    if (cacheVenues.value[near]) {
      loading.value = false

      return cacheVenues.value[near]
    }

    const { data } = await HTTP_API().post('venues/trending', { query: { near } })

    if (typeof cacheVenues.value[near] === 'undefined') {
      cacheVenues.value[near] = data
    }

    loading.value = false

    return data
  }

  return {
    loading,
    cacheVenues,
    getAutocompleteResults,
    searchVenuesTrending,
  }
})
