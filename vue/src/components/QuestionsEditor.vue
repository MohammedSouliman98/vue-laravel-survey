<template>
  <div class="p-4">
    <div class="flex justify-between">
      <h1 class="font-bold">{{ index + 1 }} . where are you form ?</h1>
      <div class="flex">
        <button
          @click="addquestion"
          class="text-xl font-bold bg-blue-500 text-white rounded px-4 py-2 ml-1 cursor-pointer" 
        >
          Add
        </button>
        <button
          @click="deletequestion"
          class="text-xl font-bold bg-red-500 text-white rounded px-4 py-2 ml-1 cursor-pointer"
       >
          Delete
        </button>
      </div>
    </div>
    <div class="flex w-full justify-between my-2">
      <div class="w-2/3">
        <label :for="'input' + model.id">Questions Text</label>
        <input
          type="text"
          v-model="model.question"
          @keyup ="emit('change' , model)"
          placeholder="Enter your question"
          :id="'input' + model.id"
          class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0 mb-4"
        />
      </div>
      <div class="w-1/3">
        <label :for="'input' + model.id">type of question</label>
        <select
          name="type"
          :id="'input' + model.id"
          v-model="model.type"
          @change ="emit('change' , model)"
          class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0 mb-4"
        >
          <option :value="type" v-for="type in typequestion" @click="datachange" :key="type">
            {{ type }}
          </option>
        </select>
      </div>
    </div>
    <label :for="'description' + model.id">Description</label>
    <textarea
      name="description"
      :id="'description' + model.id"
      v-model="model.description"
      @keyup ="emit('change' , model)"
      class="w-full border-gray-300 rounded-md shadow-sm outline-0 p-2"
      cols="30"
      rows="4"
      placeholder="Description (optional)"
    >
    </textarea>
    <div  v-if="checkifhasoptions()" class="mt-5 animate-fade-in-down">
      <div class="flex justify-between ">
        <label for="option" class="font-bold text-xl">options</label>
        <button
          @click="addoption"
          class="text-xl font-bold bg-blue-500 text-white rounded p-2"
        >
        Add options
      </button>
      </div>
      <div v-if="!model.data.options" class="w-full flex justify-center my-4">
        <div class="font-bold text-2xl">this is no potions here</div>
      </div>
      <div v-else>
        <div v-for="(option , index) in model.data.options" :key="option.uuid" class="flex justify-between m-2 animate-fade-in-down">
          <input
            type="text"
            v-model="option.text"
            @keyup ="emit('change' , model)"
            :placeholder='"option " +`${ index + 1}`'
            class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0 mb-1"
          />
          <button
          @click="deleteoption(option)"
            class="text-xl h-full font-bold bg-red-500 text-white rounded ml-3 p-2"
          >
            Delete
          </button>
        </div>
      </div>
    </div>

    <hr class="my-5" />
  </div>
</template>

<script setup>
import { ref } from "vue";
import store from "../store/index.js";
import { v4 as uuidv4 } from "uuid";

const props = defineProps({
  question: Object,
  index: Number,
});

const emit = defineEmits(["change", "addquestion", "deletequestion"]);

const typequestion = store.state.typequestion;

let model = ref(JSON.parse(JSON.stringify(props.question)));


function checkifhasoptions() {
  return ["select", "checkbox", "radio"].includes(model.value.type);
}
function getoptions(){
  return model.value.data.options || []
}
function setoptions(options){
  model.value.data.options = options
}
function addoption(e){
  e.preventDefault()
  setoptions([
    ...getoptions(),
    {uuid : uuidv4() , text : ""},
  ]);
  datachange()
}
function deleteoption(option){
  setoptions(getoptions().filter(op => op.uuid !== option.uuid));
  datachange()
}


function datachange(){
const data = JSON.parse(JSON.stringify(model.value))
console.log(data)
 if(!checkifhasoptions()){
  delete data.data.options
 }
 emit('change' , data);
}
// console.log(model.value.data)
function addquestion (e){
  e.preventDefault()
  emit("addquestion" ,  props.index + 1  )
}

function deletequestion (){
  emit("deletequestion" , props.question  )
} 
</script>

<style>
</style>