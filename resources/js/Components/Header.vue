<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
  canLogin: {
    type: Boolean,
  },
  canRegister: {
    type: Boolean,
  },
  laravelVersion: {
    type: String,
    required: true,
  },
  phpVersion: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <div v-if="canLogin" class="flex justify-between">
    <Link class="text-[32px] text-white cursor-pointer"> Booking </Link>
    <div class="flex items-center">
      <Link
        :href="route('login')"
        class="font-semibold border py-[10px] px-[17px] rounded-[20px] text-white dark:text-gray-400 dark:hover:text-white"
        >Войти</Link
      >
      <Link
        v-if="canRegister"
        :href="route('register')"
        class="ms-4 font-semibold text-black hover:text-gray-900 dark:text-gray-400 dark:hover:text-white bg-[#EBFF00] py-[10px] px-[17px] rounded-[20px]"
        >Регистрация</Link
      >
    </div>
  </div>
</template>
