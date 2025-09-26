<template>
  <div class="py-5 px-8">
    <h1 v-if="loading" class="text-center font-bold text-2xl">...Loading</h1>
    <form v-else @submit.prevent="submitSurvey" class="">
      <div class="grid grid-cols-6 items-center">
        <div class="mx-4 ">
          <img src="" alt="">
        </div>
        <div class="mx-4 my-4 col-span-5">
          <h1 class="text-3xl font-bold capitalize ">{{ survey.title }}</h1>
          <p class="w-full text-gray-500 ">{{ survey.description }}</p>
        </div>
      </div>
      <div class="text-red-500 font-bold text-2xl" v-if="surveyFinished">
        <div class="">
          the sruvey was finshed
        </div>
        <button @click="submitAnotherResponse">submit Another Response</button>
      </div>
      <div v-else>
        <hr class="my-3">
        <div class="" v-for="(question , index ) in survey.questions" :key="question.id">
          <Surveyviewer 
          v-model="answers[question.id]"
          :question="question"
          :index="index"
          />
        </div>
        <button type="submit" class="font-bold text-2xl bg-blue-500 px-3 py-2 rounded-2xl text-white flex justify-center items-center cursor-pointer">submit</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import Surveyviewer from '../components/viewer/Surveyviewer.vue';
import { useRoute } from 'vue-router';
import {useStore} from 'vuex';
import { computed , ref } from 'vue';
const route = useRoute();
const store = useStore();

const loading = computed(()=>store.state.currentsurvey.loading);
const survey = computed(()=>store.state.currentsurvey.data);

const surveyFinished = ref(false);
const answers = ref({})

store.dispatch('getSurveyBySlug' , route.params.slug);


function submitSurvey(){
  store.dispatch('saveSurveyAnswer' , {
    surveyId  : survey.value.id,
    answers  : answers.value,
  }).then((res)=> {
    if(res.status === 201){
      surveyFinished.value = true
    }
  })
}

function submitAnotherResponse(){
  answers.value = {} ;
  surveyFinished.value = false
}


</script>

<style>

</style>