<template>
  <div class="card p-4">
    <h5>Hőmérséklet – utolsó lekérdezések</h5>
    <div v-if="loading">Betöltés...</div>
    <div v-else>
      <div v-for="(chart, index) in charts" :key="index" class="mb-4">
        <h6>{{ chart.name }}</h6>
        <ApexChart
          type="bar"
          height="300"
          :options="{
            chart: { id: 'weather-' + index },
            xaxis: { categories: chart.categories, title: { text: 'Időpont' } },
            yaxis: { title: { text: 'Hőmérséklet (°C)' } },
            dataLabels: { enabled: true }
          }"
          :series="chart.series"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import ApexChart from 'vue3-apexcharts'
import axios from 'axios'

const charts = ref([])
const loading = ref(true)

onMounted(async () => {
  try {
    const { data } = await axios.get('/api/weather/history-all')
    console.log(data)
    charts.value = data.map(cityData => {
      const temperatures = cityData.data
        .map(item => item.temperature)
        .filter(v => v !== null && v !== undefined)

      const times = cityData.data
        .map(item => new Date(item.time * 1000).toISOString().slice(0, 16).replace('T', ' '))
        .filter(v => v !== null && v !== undefined)

      return {
        name: cityData.city ?? 'Ismeretlen város',
        series: [{ name: 'Hőmérséklet', data: temperatures }],
        categories: times,
      }
    })
  } catch (e) {
    console.error('API hiba:', e)
  } finally {
    loading.value = false
  }
})
</script>
