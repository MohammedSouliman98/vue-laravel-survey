<template>
  <div class="">
      <main class="flex-1 p-6">
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