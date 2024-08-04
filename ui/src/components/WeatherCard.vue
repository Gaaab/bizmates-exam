<script lang="ts" setup>
  import { useWeatherStore } from '@/modules/weather/store'
  import { storeToRefs } from 'pinia'

  defineOptions({
    name: 'WeatherCard',
    inheritAttrs: false,
  })

  const props = defineProps<{
    lat: number
    lng: number
    title: string
  }>()

  const weatherStore = useWeatherStore()
  const { loading } = storeToRefs(weatherStore)

  weatherStore.getWeatherByCoordinates(props.lat, props.lng)

  const { weatherByCoords } = storeToRefs(weatherStore)
  const result = computed(() => {
    return weatherByCoords.value[props.lat]
  })

  const currentWeather = computed(() => {
    if (!result.value) return {}
    return result.value.list[0]
  })
</script>

<template>
  <v-card
    class="text-white"
    color="dark"
    max-width="450"
  >
    <v-card-item v-if="!loading">
      <template #title>
        <div v-html="props.title" />
      </template>
      <template #subtitle>
        <p>{{ currentWeather.weather[0].main }} - {{ currentWeather.weather[0].description }}</p>
        <p>{{ currentWeather.dt }}</p>
      </template>
    </v-card-item>

    <v-card-text v-if="!loading" class="py-0">
      <v-row align="center" no-gutters>
        <v-col
          class="text-h2"
          cols="6"
        >
          {{ currentWeather.main.temp }}&deg;C
        </v-col>

        <v-col class="text-right" cols="6">
          <v-img
            :src="`https://openweathermap.org/img/wn/${currentWeather.weather[0].icon}@2x.png`"
          />
        </v-col>
      </v-row>
    </v-card-text>

    <div class="d-flex py-3 justify-space-between">
      <v-list-item
        density="compact"
        prepend-icon="mdi-weather-windy"
      >
        <v-list-item-subtitle>{{ currentWeather.main.humidity }} %</v-list-item-subtitle>
      </v-list-item>

      <v-list-item
        density="compact"
        prepend-icon="mdi-weather-pouring"
      >
        <v-list-item-subtitle>48%</v-list-item-subtitle>
      </v-list-item>
    </div>
  </v-card>
</template>
