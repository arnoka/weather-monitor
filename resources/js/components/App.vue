<template>
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <Sidebar @navigate="view = $event" />
      <div class="col p-4">
        <CurrentWeather v-if="view === 'currentweather'" />
        <Settings v-if="view === 'settings'" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import Sidebar from './Sidebar.vue'
import CurrentWeather from './CurrentWeather.vue'
import CountryCitySelector from './CountryCitySelector.vue'
import Settings from './Settings.vue'

const view = ref('currentweather')
</script>
  