<template>
  <div>
    <nav class="bg-blue-500 text-white p-4 flex justify-between items-center">
      <div class="text-lg font-bold">Dashboard</div>
      <ul class="w-1/4 flex justify-between space-x-4">
        <li><router-link :to="{name : 'Dashboard'}" class="hover:underline">Home</router-link></li>
        <li><RouterLink :to="{name : 'Surveys'}" class="hover:underline">surveys</RouterLink></li>
      </ul>
      <button @click="logout" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
        Logout
      </button>
    </nav>

    <router-view></router-view>
    <Notification></Notification> 
  </div>
</template>

<script>
import {useStore} from 'vuex';
import {RouterLink, useRouter} from 'vue-router';
import Notification from './Notification.vue';
export default {
  name: 'DefaultLayout',
  components: {
    Notification
  },
  setup(){
    const store = useStore();
    const router = useRouter();
    function logout(){
      store.commit('logout');
      router.push('/login');
    }
    return{
    logout
    }
  }
}
</script>

<style>

</style>