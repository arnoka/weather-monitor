<template>
    <div class="p-3 w-100">
      <label class="block mb-2">Ország:</label>
      <select v-model="selectedCountry" @change="updateCities" class="border p-2 mb-4 w-full">
        <option disabled value="">-- Válassz országot --</option>
        <option v-for="country in countries" :key="country.id" :value="country.id">
          {{ country.name }}
        </option>
      </select>
  
      <label class="block mb-2">Város:</label>
      <select v-model="selectedCity" :disabled="!availableCities.length" class="border p-2 w-full">
        <option disabled value="">-- Válassz várost --</option>
        <option v-for="city in availableCities" :key="city.id" :value="city.id">
          {{ city.name }}
        </option>
      </select>
    </div>
  </template>
  
  <script setup>
  import { ref, watch, onMounted } from 'vue'
  import axios from 'axios'

  const emit = defineEmits(['update:country', 'update:city'])
  
  const countries = ref([])

  onMounted(async () => {
    const response = await axios.get('/api/countries')
    countries.value = response.data
  })
  
  const selectedCountry = ref('')
  const selectedCity = ref('')
  const availableCities = ref([])
  
  const props = defineProps({
  excludeCities: {
    type: Array,
    default: () => []
  }
})

const updateCities = async () => {
  if (!selectedCountry.value) return
  const res = await axios.get(`/api/countries/${selectedCountry.value}/cities`)
  availableCities.value = res.data
}
  
watch(selectedCountry, val => emit('update:country', val))
watch(selectedCity, val => emit('update:city', val))
</script>