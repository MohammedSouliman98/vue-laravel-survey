<template>
  <div class="flex flex-col justify-between text-center mx-5">
    <img :src="survey.image" class="w-full h-70 overflow-hidden rounded-xl object-cover" alt="" />
    <h1 class="font-bold">{{ survey.title }}</h1>
    <p>{{ survey.description }}</p>
    <div class="">Data Expire At : {{ survey.expire_at }}</div>
    <div class="flex justify-evenly">
      <router-link
        :to="{ name: 'viewsurvey', params: { id: survey.id } }"
        class="flex group duration-300  hover:bg-green-500  p-3 rounded-full text-white cursor-pointer"
        >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-green-500 group-hover:text-white duration-300">
  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
</svg>

        </router-link
      >
      <a :href="`/view/survey/${survey.slug}`" target="blank" class="flex group hover:bg-blue-500 duration-300 p-3 rounded-full text-white cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-blue-500 group-hover:text-white duration-300">
  <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
</svg>

      </a>
      <button
        v-if="survey.id"
        @click="deletesurvey(survey.id)"
        class="flex group transition-colors duration-300 hover:bg-red-500  p-3 rounded-full text-white cursor-pointer"
      >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 duration-300 text-red-500 group-hover:text-white">
  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
</svg>

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
      store.commit('notify' , {
      type : "delete",
      message : 'Survey Was Deleted Successfully'
    });
      router.push({ name: "Surveys" });
    });
  }
}

</script>

<style>
</style>