<template>
  <div class="">
      <main class="flex justify-between p-6 shadow-lg rounded-lg bg-white mb-4">
        <slot name="header"></slot>
      </main>
      <header class="mx-5 ">
        <slot></slot>
      </header>
    </div>
</template>

<script setup >
const props = defineProps({
  title: {
    type: String,
  }
});
</script>

<style>

</style>