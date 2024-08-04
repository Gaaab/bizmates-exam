<script lang="ts" setup>
  import { debounce } from '@/helpers/utils'
  import { useMapStore } from '@/modules/maps/store'

  const router = useRouter()
  const places = ['Tokyo', 'Hiroshima', 'Fukuoka', 'Kyoto', 'Osaka', 'Sapporo', 'Nagoya', 'Hakone', 'Nagasaki']
  const search = ref(places[0])

  const mapStore = useMapStore()
  mapStore.searchVenuesTrending(search.value)
  router.replace({ query: { query: search.value } })

  const onHandleModelValueUpdate = (value: string) => {
    mapStore.searchVenuesTrending(value)
  }

  const onHandleSearch = debounce((q: string) => {
    if (q?.length >= 3) {
      // mapStore.getAutocompleteResults(q)
      router.replace({ query: { query: q } })
    }
  }, 500)
</script>

<template>
  <v-autocomplete
    v-model="search"
    auto-select-first
    class="mx-auto"
    clearable
    density="comfortable"
    item-props
    :items="places"
    menu-icon=""
    placeholder="Search Places"
    prepend-inner-icon="mdi-magnify"
    rounded
    variant="solo"
    @update:model-value="onHandleModelValueUpdate"
    @update:search="onHandleSearch"
  />
</template>
