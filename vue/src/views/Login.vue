<template>
  <div class="">
    <h2 class="text-xl font-semibold mb-4">Login</h2>
      <form>
        <div class="mb-4">
          <label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="Email" id="Email" placeholder="Enter your Email" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" placeholder="Your Password" class="mt-1 p-2 block w-full border-gray-300 rounded-md shadow-sm outline-0">
        </div>
        <div class="flex justify-between">
         <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</button>
         <a href="#" class="text-sm text-blue-500 hover:underline self-center">Forgot Password?</a>
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