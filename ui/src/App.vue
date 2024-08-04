<script lang="ts" setup>
  import { useLocale } from 'vuetify'
  const { current } = useLocale()
</script>

<template>
  <router-view v-slot="{ Component }">
    <v-fade-transition appear>
      <v-layout class="rounded rounded-md">
        <component :is="Component" />
      </v-layout>
    </v-fade-transition>
  </router-view>
</template>
