<template>
  <Pagecomponent>
    <template v-slot:header>
      <div class="flex justify-between">
        <h1 class="text-3xl font-bold mb-4">Surveys</h1>
        <Router-Link
          :to="{ name: 'createsurvey' }"
          class="text-xl font-bold bg-blue-500 text-white rounded p-2 cursor-pointer hover:bg-blue-600"
        >
          Create New Form
        </Router-Link>
      </div>
    </template>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
      <div class="" v-for="survey in surveys" :key="survey.id">
        <div class="flex flex-col text-center mx-5">
          <img :src="survey.image" alt="">
          <h1 class="font-bold">{{ survey.title }}</h1>
          <p>{{ survey.description }}</p>
          <div class="">Data Expire At : {{ survey.expire_at }}</div>
          <div class="flex justify-between">
            <router-link :to="{name : 'viewsurvey' , params: {id : survey.id}}" class=" flex bg-green-500 px-6 py-2 rounded text-white cursor-pointer">Edit</router-link>  
            <button v-if="survey.id" @click="deletesurvey(survey)"  class=" flex bg-red-500 px-6 py-2 rounded text-white cursor-pointer">delete</button>  
          </div>
        </div>
      </div>
    </div>
  </Pagecomponent>
</template>

<script setup>
import Pagecomponent from "../components/pagecomponent.vue";
import { computed } from "vue";
import store from "../store/index.js";

const surveys = computed(() => store.state.surveys);


function deletesurvey(survey) {
  if ( confirm("Are you sure you want to delete this survey?") ) {
    // store.dispatch("deletesurvey", survey);
  }
}
</script>