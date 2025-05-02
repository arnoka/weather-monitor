
<template>
    <div class="container mt-5">
      <h1 class="text-center">🌤️ Weather Monitor App</h1>
  
      <div class="card mt-4">
        <div class="card-body">
          <h5 class="card-title">Város kiválasztás</h5>
  
          <form>
            <div class="mb-3">
              <label for="country" class="form-label">Ország</label>
              <input type="text" id="country" class="form-control" placeholder="Pl. Hungary">
            </div>
  
            <div class="mb-3">
              <label for="city" class="form-label">Város</label>
              <input type="text" id="city" class="form-control" placeholder="Pl. Budapest">
            </div>
  
            <div class="mb-3">
              <label for="cron" class="form-label">Cron kifejezés</label>
              <input type="text" id="cron" class="form-control" placeholder="Pl. */5 * * * *">
            </div>
  
            <button type="submit" class="btn btn-primary">Hozzáadás</button>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  </script>
  