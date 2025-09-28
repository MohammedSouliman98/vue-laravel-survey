<template>
  <Pagecomponent>
    <template v-slot:header>
      <div class="w-full flex justify-between">
        <h1 class="text-3xl font-bold mb-4">Surveys</h1>
        <Router-Link
          :to="{ name: 'createsurvey' }"
          class="text-xl font-bold bg-blue-500 text-white rounded p-2 cursor-pointer hover:bg-blue-600"
        >
          Create New Form
        </Router-Link>
      </div>
    </template>
    <h1 v-if="loading" class="text-center font-bold text-2xl">...Loading</h1>
    <div v-else>
      <template class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <surveylistitem
        v-for="(survey , ind) in surveys"
        :key="survey.id"
        :survey="survey"
        class="opacity-0 animate-fade-in-down"
        :style="{animationDelay :` ${ind * 0.2}`}"
      />
    </template>
    <div class="flex justify-center items-center my-3 shadow-2xl">
      <a class=" h-10 min-w-10 px-2 border border-gray-500 text-center content-center cursor-pointer shadow-2xl" :class="[link.active ? 'bg-gray-500 text-white' : 'bg-gray-100' , i===0 ? 'rounded-bl-xl rounded-tl-xl' : null  , i === links.length - 1 ? 'rounded-br-xl rounded-tr-xl' : null ]" v-for="(link , i ) in links" :key="i"  :disabled="!link.url" @click="getforlink(link)" v-html="link.label">
        
      </a>
    </div>
    </div>
  </Pagecomponent>
</template>

<script setup>
import Pagecomponent from "../components/pagecomponent.vue";
import surveylistitem from "../components/surveyListItem.vue";
import { computed, watch } from "vue";
import store from "../store/index.js";
import { useRoute } from "vue-router";

const router = useRoute();
const surveys = computed(() => store.state.surveys.data);
const links = computed(()=> store.state.links);
const loading = computed(()=> store.state.surveys.loading);
function getforlink(link){
  if(link.active || !link.url){
    return ;
  }
  store.dispatch("fetchsurveys" , {url: link.url });
}

store.dispatch("fetchsurveys");


</script>