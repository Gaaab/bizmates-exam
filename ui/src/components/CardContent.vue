<script lang="ts" setup>
  import WeatherDialog from './WeatherDialog.vue'

  const props = defineProps<{
    location: any
    categories: Array<any>
    createdAt: number
    id: string
    name: string
  }>()

  const show = ref(false)

  const showWeatherDialog = ref(false)
</script>

<template>
  <WeatherDialog :location="props.location" :show="showWeatherDialog" @close="showWeatherDialog = false" />
  <v-card>
    <v-card-title>{{ props.name }}</v-card-title>
    <v-card-subtitle>{{ props.location.formattedAddress.join(' ') }}</v-card-subtitle>
    <v-card-actions>
      <!--<v-btn
        color="orange-lighten-2"
        icon="mdi-weather-cloudy"
        text="Show Weather"
        @click="showWeatherDialog = true"
      />-->

      <v-spacer />

      <v-btn
        :icon="show ? 'mdi-chevron-up' : 'mdi-chevron-down'"
        @click="show = !show"
      />
    </v-card-actions>

    <v-expand-transition>
      <div v-show="show">
        <v-divider />

        <v-card-text>
          Related Venues:
        </v-card-text>
      </div>
    </v-expand-transition>
  </v-card>
</template>
