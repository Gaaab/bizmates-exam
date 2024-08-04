<script lang="ts" setup>
  import { useMapStore } from '@/modules/maps/store'
  import { storeToRefs } from 'pinia'
  import CardContent from './CardContent.vue'

  const mapStore = useMapStore()
  const { cacheVenues, loading } = storeToRefs(mapStore)
  const route = useRoute()
  const results = computed(() => {
    return cacheVenues.value[route.query?.query ?? ''] || {}
  })
</script>

<template>
  <h2>Search Results...</h2>
  <div>
    <v-row
      v-for="(result, key, index) in results"
      :key="`v_${index}`"
      dense
      class="mt-2"
    >
      <v-col cols="12">
        <div v-if="key === 'geocode'">
          <h5>Weather</h5>
          <WeatherCard
            v-if="!loading"
            class="mt-4"
            :title="result.feature.highlightedName"
            :lat="result.feature.geometry.center.lat"
            :lng="result.feature.geometry.center.lng"
          />
        </div>
        <div v-if="key === 'venues'">
          <CardContent
            v-for="(venue, idx) in result"
            :key="`v_${idx}`"
            v-bind="venue"
          />
        </div>
      </v-col>

    </v-row>
  </div>
</template>
