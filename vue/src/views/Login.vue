<template>
  <div class="">
    <h2 class="text-xl font-semibold mb-4">Login</h2>
      <form @submit="login">
        <p v-if="errmessage" class="text-red-500 mb-4">{{ errmessage }}</p>
        <div class="mb-4">
          <label for="Email"  class="block text-sm font-medium text-gray-700">Email</label>
          <input type="Email" id="Email" v-model="user.email" placeholder="Enter your Email" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" v-model="user.password" placeholder="Your Password" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="flex justify-between">
         <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</button>
         <a href="#" class="text-sm text-blue-500 hover:underline self-center">Forgot Password?</a>
        </div>
      </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import store from '../store';
import { useRouter } from 'vue-router';

let errmessage = ref('');
const router = useRouter();

const user = {
  email: '',
  password: '',
}

function login(e) {
e.preventDefault();
store.dispatch('login', user).then(
  () => {
    router.push('/dashboard');
  }
).catch((err)=>{
  errmessage.value = err.response.data.message;
});
}

</script>

<style>

</style>