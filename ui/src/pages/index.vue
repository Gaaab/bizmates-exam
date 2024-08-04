<script setup lang="ts">
  import HeaderComponent from '@/components/Header.vue'
  import FooterComponent from '@/components/Footer.vue'
  import SearchBar from '@/components/SearchBar.vue'
  import { useMapStore } from '@/modules/maps/store'
  import { storeToRefs } from 'pinia'

  const mapStore = useMapStore()
  const { loading } = storeToRefs(mapStore)
</script>

<template>
  <v-app>
    <!-- Header -->
    <HeaderComponent />

    <!-- Main Section -->
    <v-main class="bg-grey-lighten-5">
      <v-container class="text-center">
        <div class="mt-4">
          <h1 class="font-weight-black text-h4 text-sm-h3">
            Wander Japan
          </h1>
        </div>
        <div class="mb-4">
          <p class="subtitle-1 text-center white--text mt-1 mb-2">
            Discover Japan: Your Gateway to Perfect Journeys and Weather Insights
          </p>
        </div>
        <v-row dense>
          <v-col
            class="mt-2"
            cols="12"
          >
            <SearchBar />
          </v-col>
        </v-row>
      </v-container>
      <v-container v-if="!loading" class="mb-2">
        <!-- Contents -->
        <SearchContents />
      </v-container>
    </v-main>

    <!-- Footer -->
    <FooterComponent />
  </v-app>
</template>
