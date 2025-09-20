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
    <template class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">

      <surveylistitem
        v-for="survey in surveys"
        :key="survey.id"
        :survey="survey"
      />
    </template>
  </Pagecomponent>
</template>

<script setup>
import Pagecomponent from "../components/pagecomponent.vue";
import surveylistitem from "../components/surveyListItem.vue";
import { computed, watch } from "vue";
import store from "../store/index.js";
import { useRoute } from "vue-router";

const router = useRoute();
const surveys = computed(() => store.state.surveys);

store.dispatch("fetchsurveys");


</script>