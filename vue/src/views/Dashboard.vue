<template>
    <Pagecomponent > 
      <template v-slot:header>
        <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
        
      </template>
      <p class="">This is where the main content will go.</p>
      <!-- <div class="h-screen content-center">
      <div class="bg-white p-4 shadow-md mx-auto rounded">
        <div class="flex justify-between p-4">
          <h2 class="text-xl font-semibold mb-4">Questions</h2>
          <button class="text-xl font-bold bg-blue-500 text-white rounded p-2">
            Add Questions
          </button>
        </div>
        <form class="">
          <div class="p-4">
            <div class="flex justify-between">
              <h1 class="font-bold">1 . where are you form ?</h1>
              <div class="">
                <button
                  class="text-xl font-bold bg-blue-500 text-white rounded p-2">
                  Add
                </button>
                <button
                  class="text-xl font-bold bg-red-500 text-white rounded p-2">
                  Delete
                </button>
              </div>
            </div>
            <div class="flex w-full justify-between">
              <div class="w-full" >
                <label for="input-1">Questions Text</label>
                <input
                  type="text"
                  placeholder="Enter your question"
                  id="input-1"
                  class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0 mb-4" />
              </div>
              <div class="w-1/4 ml-4">
                <label for="input-2">type of question</label>
                <select name="type" id="input-2" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0 mb-4">
                  <option value="text">text</option>
                  <option value="radio">radio</option>
                  <option value="checkbox">checkbox</option>
                  <option value="dropdown">dropdown</option>
                </select>
              </div>
            </div>
            <label for="description">Description</label>
            <textarea name="description" id="description" class="w-full border-gray-300 rounded-md shadow-sm outline-0 p-2" cols="30" rows="4" placeholder="Description (optional)">

            </textarea> 
             <div class="flex justify-between ">
              <label for="option" class="font-bold text-xl">options</label>
              <button class="text-xl font-bold bg-blue-500 text-white rounded p-2">
                Add options
              </button>
             </div>
              <div class="w-full justify-between">
                <div class="flex justify-between m-2">
                  <input type="text" placeholder="option 1" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0 mb-4">
                  <button class="text-xl h-full font-bold bg-red-500 text-white rounded p-2">D</button>
                </div>
                <div class="flex justify-between m-2">
                  <input type="text" placeholder="option 1" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0 mb-4">
                  <button class="text-xl h-full font-bold bg-red-500 text-white rounded p-2">D</button>
                </div>
                <div class="flex justify-between m-2">
                  <input type="text" placeholder="option 1" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0 mb-4">
                  <button class="text-xl h-full font-bold bg-red-500 text-white rounded p-2">D</button>
                </div>
              </div>
              <hr>
          </div>
        </form>
      </div>
    </div> -->
    </Pagecomponent>
</template>

<script setup>
import { RouterLink } from "vue-router";
import Pagecomponent from "../components/pagecomponent.vue";
</script>