<script setup>
defineProps({
  showConfirmation: Boolean,
  selectedBook: String,
  text: String,
});
</script>
<template>
  <div class="dark"></div>
  <div class="max-w-[1470px] p-[15px] m-auto">
    <!-- Ваш код -->

    <!-- Всплывающее окно -->
    <div
      v-if="showConfirmation"
      class="fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50 z-50"
    >
      <div
        class="bg-white p-8 rounded-lg flex flex-col items-center gap-[10px]"
      >
        <p class="bg-blue-500 text-white px-4 py-2 mt-4 rounded-md">
          {{ text }}
        </p>
        <img
          class="max-w-[100px]"
          src="./../../img/znak.png"
          alt="знак галочки"
        />
      </div>
    </div>
  </div>
</template>
<style scoped>
</style>
