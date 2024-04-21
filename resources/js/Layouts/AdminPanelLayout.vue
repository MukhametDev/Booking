<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import AdminAuthenticated from "@/Layouts/AdminAuthenticated.vue";
import Users from "@/Pages/Users.vue";
import AdminPanel from "@/Pages/AdminPanel.vue";
import { useRouter, useRoute } from "vue-router";
import { Link } from "@inertiajs/vue3";
</script>
<template>
  <div class="max-w-[1470px] p-[15px] m-auto">
    <Head title="Админ панель" />
    <AdminAuthenticated>
      <h1 class="text-center text-[32px] text-white mb-[30px]">
        Admin Dashboard
      </h1>
    </AdminAuthenticated>
    <div class="flex gap-[10px] justify-end items-end mb-[30px]">
      <Link
        :href="route('admin/auditoriums')"
        class="border-[1px] border-yellow-400 bg-[#EBFF00] outline-none border-none text-black p-[5px] cursor-pointer rounded-[10px]"
      >
        Аудитории
      </Link>
      <Link
      :href="route('admin/users')"
        class="border-[1px] border-yellow-400 bg-[#EBFF00] outline-none border-none text-black p-[5px] cursor-pointer rounded-[10px]"
      >
        Пользователи
      </Link>
    </div>
  </div>
</template>

