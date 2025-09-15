<template>
    <Pagecomponent > 
      <template v-slot:header>
        <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
        
      </template>
      <p class="">This is where the main content will go.</p>
    </Pagecomponent>
</template>

<script setup>
import { RouterLink } from "vue-router";
import Pagecomponent from "../components/pagecomponent.vue";
</script>