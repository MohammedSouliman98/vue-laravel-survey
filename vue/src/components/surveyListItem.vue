<template>
  <div class="flex flex-col text-center mx-5">
    <img :src="survey.image" alt="" />
    <h1 class="font-bold">{{ survey.title }}</h1>
    <p>{{ survey.description }}</p>
    <div class="">Data Expire At : {{ survey.expire_at }}</div>
    <div class="flex justify-between">
      <router-link
        :to="{ name: 'viewsurvey', params: { id: survey.id } }"
        class="flex bg-green-500 px-6 py-2 rounded text-white cursor-pointer"
        >Edit</router-link
      >
      <button
        v-if="survey.id"
        @click="deletesurvey(survey.id)"
        class="flex bg-red-500 px-6 py-2 rounded text-white cursor-pointer"
      >
        delete
      </button>
    </div>
  </div>
</template>

<script setup>
import { computed } from "vue";
import store from "../store/index.js";
import { useRouter } from "vue-router";
const router = useRouter();
const props = defineProps({
  survey: Object,
});

const survey = computed(() => props.survey);

function deletesurvey(id) {
  if (confirm("Are you sure you want to delete this survey?")) {
    store.dispatch("deletesurvey", id).then(() => {
      router.push({ name: "Dashboard" });
    });
  }
}

</script>

<style>
</style>