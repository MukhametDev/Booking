<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
import Form from "@/Components/Form.vue";
import ButtonChoice from "@/Components/ButtonChoice.vue";
import { ref } from "vue";

let showModal = ref(false);
const handleShowModal = () => {
  showModal.value = true;
};
const handleCloseModal = () => {
  showModal.value = false;
};
</script>

<template>
  <Head title="Бронирование" />
  <div class="pt-[40px] px-[15px] max-w-[1470px] my-0 mx-auto">
    <Header can-login="" can-register="" />
    <ButtonChoice @click="handleShowModal" />
  </div>
  <Form :show-modal="showModal" @close="handleCloseModal" />
</template>


