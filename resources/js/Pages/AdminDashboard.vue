<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import AdminAuthenticated from "@/Layouts/AdminAuthenticated.vue";
import Users from "@/Pages/Users.vue";
import AdminPanel from "@/Pages/AdminPanel.vue";
import { useRouter, useRoute } from "vue-router";
const router = useRouter();
const route = useRoute();
import AdminPanelLayout from "@/Layouts/AdminPanelLayout.vue";
import { Link } from "@inertiajs/vue3";
</script>
<template>
  <AdminPanelLayout />
</template>
<style scoped>
</style>
