<script lang="ts" setup>
  import { useWeatherStore } from '@/modules/weather/store'
  import { storeToRefs } from 'pinia'

  defineOptions({
    name: 'WeatherDialog',
    inheritAttrs: false,
  })

  const props = withDefaults(
    defineProps<{
      show?: boolean
      location?: any
    }>(),
    {
      show: false,
      location: {
        lat: 0,
        lng: 0,
      },
    }
  )

  const emit = defineEmits(['close'])

  const weatherStore = useWeatherStore()
  const { loading } = storeToRefs(weatherStore)
</script>

<template>
  <v-dialog
    :model-value="props.show"
    persistent
    width="auto"
  >
    <v-card
      color="#F9F9F9"
      max-width="500"
    >
      <v-list-item two-line>
        <v-list-item-content>
          <v-list-item-title class="headline">San Francisco</v-list-item-title>
          <v-list-item-subtitle>Mon, 12:30 PM, Mostly sunny</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
      <template #actions>
        <v-btn
          class="ms-auto"
          text="Ok"
          @click="emit('close')"
        />
      </template>
    </v-card>
  </v-dialog>
</template>
