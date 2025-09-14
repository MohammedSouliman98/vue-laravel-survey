<template>
  <div class="">
    <h2 class="text-xl font-semibold mb-4">SignUp</h2>
      <form>
        <div class="mb-4">
          <label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="Email" placeholder="Enter your Email" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="mb-4">
          <label for="Username" class="block text-sm font-medium text-gray-700">Username</label>
          <input type="text" id="Username" placeholder="Enter your username" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" placeholder="Your Password" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="mb-4">
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">password_confirmation</label>
          <input type="password" id="password_confirmation" placeholder="password_confirmation" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="flex justify-between">
         <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">SignUp</button>
         <div class="">
            already have an account
         <a href="#"  class="text-sm text-blue-500 hover:underline self-center">Login</a>
         </div>
        </div>
      </form>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>