<template>
    <div class="card p-4">
      <CountryCitySelector
        @update:country="selectedCountry = $event"
        @update:city="selectedCity = $event"
        :excludeCities="savedCities"
      />
  
      <div class="mt-3">
        <button class="btn btn-primary me-2" @click="addCity" :disabled="!selectedCity">
          Város hozzáadása
        </button>
        <button class="btn btn-outline-secondary" @click="importCities">
          Városok lekérése API-ból
        </button>
  
        <div class="mt-2">
          <span
            v-for="(cityId, index) in savedCities"
            :key="cityId"
            class="badge bg-secondary me-1 d-inline-flex align-items-center"
          >
            {{ cityId }}
            <button
              @click="removeCity(index)"
              class="btn-close btn-close-white btn-sm ms-2"
              aria-label="Törlés"
            ></button>
          </span>
        </div>
      </div>
  
      <div class="mt-4">
        <label for="valueInput">Lekérdezés gyakorisága:</label>
        <input
          type="number"
          id="valueInput"
          v-model.number="integerValue"
          class="form-control"
          min="0"
          step="1"
        />
      </div>
  
      <div class="mt-4">
        <button class="btn btn-success" @click="saveData">Mentés API-n keresztül</button>
      </div>
    </div>
  </template>
  
  <script setup>
    import { ref, onMounted } from 'vue'
    import axios from 'axios'
    import CountryCitySelector from './CountryCitySelector.vue'
    
    const selectedCountry = ref('')
    const selectedCity = ref('')
    const savedCities = ref([])
    const integerValue = ref(0)
    
    function addCity() {
      console.log(selectedCity)
      if (
        selectedCity.value &&
        !savedCities.value.includes(selectedCity.value)
      ) {
        savedCities.value.push(selectedCity.value)
        selectedCity.value = ''
      }
    }
  
    async function saveData() {
        try {
        const payload = {
            cities: savedCities.value,
            value: integerValue.value
        }
        await axios.post('/api/save-settings', payload)
        alert('Sikeresen elmentve!')
        } catch (error) {
        console.error('Mentés sikertelen:', error)
        alert('Hiba történt a mentés során.')
        }
    }

    function removeCity(index) {
        savedCities.value.splice(index, 1)
    }

    async function importCities() {
      try {
        await axios.post('/api/countries/import')
        alert('Országok és városok sikeresen betöltve!')
      } catch (e) {
        alert('Nem sikerült az adatok betöltése.')
        console.error(e)
      }
    }

    onMounted(async () => {
        try {
        const response = await axios.get('/api/settings')
        savedCities.value = response.data.cities || []
        integerValue.value = response.data.value || 0
        } catch (error) {
        console.warn('Nincs mentett adat vagy hiba történt:', error)
        }
    })

</script>
  