<template>
  <div class="">
    <h2 class="text-xl font-semibold mb-4">SignUp</h2>
      <Aleart v-if="'Object.keys(errmessage).length'">
        <div class="my-2" v-for="(field , index) in Object.keys(errmessage)" :key="index">
          <div v-for="(err , i) in errmessage[field] || []" :key="i">{{ err }}</div>
        </div>
      </Aleart>
      <aleart v-else>
        <div > {{ message }}</div>  
      </aleart>
      <form @submit="register" >
        <div class="mb-4">
          <label for="Username" class="block text-sm font-medium text-gray-700">Username</label>
          <input type="text" name="name" id="Username" v-model="user.name" placeholder="Enter your username" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="mb-4">
          <label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" name="email" id="Email" v-model="user.email" placeholder="Enter your Email" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="pssword" id="password" v-model="user.password" placeholder="Your Password" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="mb-4">
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">password_confirmation</label>
          <input type="password" name="password_confirmation" id="password_confirmation" v-model="user.password_confirmation" placeholder="password_confirmation" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="flex justify-between">
         <button type="submit" :class="{'bg-blue-500/60' : loading , 'hover:bg-blue-500/60' : loading}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">{{ loading ? 'loading' : "SignUp" }}</button>
         <div class="">
            already have an account
         <a href="login"  class="text-sm text-blue-500 hover:underline self-center">Login</a>
         </div>
        </div>
      </form>
  </div>
</template>

<script setup>
import store from '../store';
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import Aleart from '../components/Aleart.vue'


const router = useRouter();
const loading = ref(false);
const errmessage = ref('');
const message =ref('');
const user = {
  email: '',
  name: '',
  password: '',
  password_confirmation: ''
}

function register(e) {
  loading.value = true;
e.preventDefault();
store.dispatch('register', user).then(
  () => {
    loading.value = false;
    router.push('/dashboard');
  }
).catch((err) => {
  loading.value = false;
  errmessage.value = err.response.data.errors;
  message.value = err.response.data.message ;

});
}
</script>

<style>

</style>