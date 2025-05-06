<template>
    <div :class="['bg-dark text-white h-100 p-3 transition', collapsed ? 'col-1' : 'col-3']">
      <button class="btn btn-outline-light btn-sm mb-3" @click="toggle">
        {{ collapsed ? '☰' : '✖' }}
      </button>
      <ul v-if="!collapsed" class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link text-white" href="#" @click.prevent="$emit('navigate', 'currentweather')">
              Aktuális idő
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#" @click.prevent="$emit('navigate', 'settings')">
              Beállítások
          </a>
        </li>
      </ul>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  const collapsed = ref(false)
  const toggle = () => collapsed.value = !collapsed.value
  </script>
  
  <style scoped>
  .transition {
    transition: width 0.3s ease;
  }
  </style>