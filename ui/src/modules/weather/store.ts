import { HTTP_API } from '@/services/http'
import { defineStore } from 'pinia'

export const useWeatherStore = defineStore('WEATHER_STORE', () => {
  const loading = ref(false)

  const weatherByCoords = ref<Record<number, any>>({})

  const getWeatherByCoordinates = async (lat: number, lng: number) => {
    loading.value = true

    if (weatherByCoords.value[lat]) {
      loading.value = false
      return weatherByCoords.value[lat]
    }

    const { data } = await HTTP_API().post('weather/get-by-coordinates', { lat, lng })

    weatherByCoords.value[lat] = data

    loading.value = false

    return data
  }

  const getWeatherByCity = async (city: string) => {
    loading.value = true

    const { data } = await HTTP_API().post('weather/get-by-city', { city })

    loading.value = false

    return data
  }

  return {
    loading,
    weatherByCoords,
    getWeatherByCoordinates,
    getWeatherByCity,
  }
})
