<template>
    <Pagecomponent > 
      <template v-slot:header>
        <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
        
      </template>
    <h1 v-if="loading" class="text-center font-bold text-2xl">...Loading</h1>
      <div v-else class="grid gird-cols-1 md:grid-cols-2 gap-3 lg:grid-cols-3 h-100 ">
        <div class="shadow-md hover:shadow-2xl rounded-xl p-2 flex flex-col justify-evenly px-3 animate-fade-in-down" style="animation-delay: 0.1s;">
          <h1 class="text-2xl font-bold ">Latest Survey</h1>
          <img :src="data.latestSurvey.image" class="min-h-[50%]" alt="">
          <h1 class="text-xl font-medium">{{ data.latestSurvey.title }}</h1>
          <div class="flex justify-between">
            <span class="py-2">status : </span>
            <span class="px-3 py-2 bg-gray-500 rounded-2xl text-white" >{{ data.latestSurvey.status ? 'Active' : 'draft' }}</span>
          </div>
          <div class="flex justify-between">
            <span>created at : </span>
            <span>{{ data.latestSurvey.created_at }}</span>
          </div>
          <div class="flex justify-between">
            <span>uploaded at : </span>
            <span>{{ data.latestSurvey.updated_at }}</span>
          </div>
          <div class="flex justify-between">
            <span>Answers: </span>
            <span>{{ data.latestSurvey.answers }}</span>
          </div>
          <div class="flex justify-between">
            <span>Questions: </span>
            <span>{{ data.latestSurvey.questions }}</span>
          </div>
          <div class="flex justify-between">
            <router-link :to="{ name: 'viewsurvey', params: { id: data.latestSurvey.id} }" class="border border-gray-500 border-2  rounded-lg px-2 py-1 cursor-pointer font-medium hover:bg-gray-500 hover:text-white">Edit Answers</router-link>
            <button class="border border-gray-500 border-2  rounded-lg px-2 py-1 cursor-pointer font-medium hover:bg-gray-500 hover:text-white">view Answers</button>
          </div>
        </div>
        <div class="shadow-md hover:shadow-2xl rounded-xl p-2 flex flex-col justify-evenly text-center  animate-fade-in-down"  style="animation-delay: 0.2s;">
          <div class="shadow-md  rounded-xl h-full content-center">
            <h1 class="text-2xl font-bold">Total Surveys</h1>
            <span class="text-7xl font-bold text-gray-500">{{ data.totalSurvey }}</span>
          </div>
          <div class="shadow-md  rounded-xl h-full content-center">
            <h1 class="text-2xl font-bold">Total Answers</h1>
            <span class="text-7xl font-bold text-gray-500">{{ data.totalAnswers }}</span>
          </div>
        </div>
        <div class="shadow-md hover:shadow-2xl rounded-xl p-2 flex flex-col justify-evenly text-center  animate-fade-in-down"   style="animation-delay: 0.3s;">
          <h1 class="text-2xl font-bold">Latest Answers</h1>
          <div>
            <a href="" v-for="answer in data.latestAnswers" :key="answer.id">
              <div>{{ answer.title }}</div>
              <small class="font-semibold">maded at : <i>{{ answer.created_at }}</i></small>
            </a>
          </div>
        </div>
      </div>
    </Pagecomponent>
</template>

<script setup>
import { RouterLink } from "vue-router";
import { computed } from "vue";
import store from '../store'
import Pagecomponent from "../components/pagecomponent.vue";



const loading = computed(()=> store.state.Dashboard.loading);
const data = computed(()=> store.state.Dashboard.data) ;


store.dispatch('getDashboardDate')

</script>