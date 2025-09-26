<template>
  <div class="">
    <h2 class="text-xl font-semibold mb-4">Login</h2>
      <form @submit="login">
        <Aleart v-if="Object.keys(errmessage).length">
          <div class="my-2" v-for="(field , index) in Object.keys(errmessage)" :key="index">
            <div v-for="(err , i) in errmessage[field] || []" :key="i">{{ err }}</div>
          </div>
        </Aleart>
        <aleart v-else>
          <div > {{ message }}</div>  
        </aleart>
        <div class="mb-4">
          <label for="Email"  class="block text-sm font-medium text-gray-700">Email</label>
          <input type="Email" id="Email" v-model="user.email" placeholder="Enter your Email" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" v-model="user.password" placeholder="Your Password" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="flex justify-between">
         <button :disabled="loading" type="submit" :class="{'bg-blue-500/60' : loading , 'hover:bg-blue-500/60': loading}"  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">{{ loading ? 'loading' : 'Login' }}</button>
         <a href="register" class="text-sm text-blue-500 hover:underline self-center">Don't Have Account</a>
        </div>
      </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import store from '../store';
import { useRouter } from 'vue-router';
import Aleart from '../components/Aleart.vue'

let errmessage = ref('');
const router = useRouter();
const loading = ref(false);
const message = ref('');

const user = {
  email: '',
  password: '',
}

function login(e) {
e.preventDefault();
loading.value = true;
store.dispatch('login', user).then(
  () => {
    loading.value = false;
    router.push('/dashboard');
  }
).catch((err)=>{
  loading.value = false;
  errmessage.value = err.response.data.errors ||{};
  message.value = err.response.data.message ;
});
}

</script>

<style>

</style>