<template>
  <pagecomponent class="lg:w-[60%] lg:mx-auto">
    <template v-slot:header>
      <h1 class="font-bold text-2xl">
        {{ model.id ? model.title : "Create A New Survey" }}
      </h1>
    </template>
    <form action="" @submit.prevent="">
      <!-- Survey Field   -->
      <div class="image rounded-2xl">
        <label for="image">Image</label>
        <div class="w-80 flex justify-between items-center">
          <img
            v-if="model.image"
            :src="model.image"
            alt=""
            id="image"
            class="w-32 h-32 rounded-full bg-red-500 object-cover rounded-2xl"
          />
          <div
            class="w-32 h-32 rounded-full flex justify-center items-center"
            v-else
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="currentColor"
              class="size-20"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
              />
            </svg>
          </div>
          <button
            class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-600 relative"
          >
            change
            <input
              type="file"
              class="absolute top-0 right-0 left-0 bottom-0 opacity-0 cursor-pointer"
            />
          </button>
        </div>
      </div>
      <!-- title -->
      <div class="mb-5">
        <label for="title" class="font-bold text-lg">Title</label>
        <input
          type="text"
          id="title"
          v-model="model.title"
          placeholder="Enter Title"
          class="w-full rounded p-2 border-gray-300 shadow-lg h-10 border-1 focus:border-blue-300 focus:ring-blue-300 outline-0"
        />
      </div>
      <!-- description -->
      <div class="mb-5">
        <label for="description" class="font-bold text-lg">description</label>
        <textarea
          v-model="model.description"
          placeholder="Enter description"
          name="description"
          id="description"
          class="w-full rounded p-2 border-gray-300 shadow-lg border-1 focus:border-blue-300 focus:ring-blue-300 outline-0"
          rows="5"
          cols="30"
        ></textarea>
      </div>
      <!-- Date -->
      <div class="mb-5">
        <label for="data">Expire Date</label>
        <input
          type="Date"
          id="data"
          v-model="model.expire_at"
          class="w-full rounded p-2 border-gray-300 shadow-lg h-10 border-1 focus:border-blue-300"
        />
      </div>
      <!-- status -->
      <div class="mb-5">
        <div class="flex justify-between items-center w-30">
          <input
            type="checkbox"
            name="status"
            id="status"
            class="w-5 h-5"
            v-model="model.status"
          />
          <label for="status" class="mr-5">Status</label>
        </div>
      </div>

      <div class="mb-5 ">
         <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold mb-4">Questions</h2>
         </div>
         <div v-if="!model.questions.length" class="flex justify-center">
            <p>you don't have any question yet , would Add Questions ??</p>
         </div>
         <div v-else v-for="(question , index) in model.questions" :key="question.index">
            <QuestionsEditor 
            :question="question"
            :index="index"
            @change="questionchange"
            @addquestion="addquestion"
            @deletequestion="deletequestion"
            />
         </div>
      </div>

      <!-- save button -->

      <div class="save flex justify-end">
        <button
          type="submit"
          class="px-6 py-2 text-white bg-blue-500 rounded-lg cursor-pointer"
        >
          Save
        </button>
      </div>
    </form>
  </pagecomponent>
</template>

<script setup>
import pagecomponent from "../components/pagecomponent.vue";
import QuestionsEditor from "../components/QuestionsEditor.vue";
import { v4 as uuidv4 } from "uuid";
import { ref } from "vue";
import store from "../store/index.js";
import { useRoute } from "vue-router";

const route = useRoute();

let model = ref({
  title: "",
  status: "false",
  description: "",
  image: "",
  expire_at: "",
  questions: [],
});
if (route.params.id) {
  model.value = store.state.surveys.find((s) => s.id == route.params.id);
}
function addquestion(index) {
  const newquestion = { 
    id : uuidv4(),
    type : 'textarea',
    question : '',
    description : null,
    data: {},
  };
  // console.log("the index of this element you clicked on is " , index);
  model.value.questions.splice(2 , 0, newquestion);

  }


  function deletequestion(question) {
    model.value.questions = model.value.questions.filter((q) => q.id !== question.id);
  }

  function questionchange(question){
    model.value.questions = model.value.questions.map(
      (q) => (q.id === question.id ? JSON.parse(JSON.stringify(question)) : q)
    )
  }
</script>

<style>
</style>