<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";

defineProps({
  visible: Boolean,
  
});
const emit = defineEmits(["handleCloseModal"]);
const submitAuditorium = () => {
  form.post(route("admin/auditoriums/store"));
};
const form = useForm({
  name: "",
  description: "",
  floor: "",
  phone: "",
  capacity: "",
});
</script>

<template>
  <div v-if="visible" class="">
    <div class="wrapper absolute left-0 right-0 top-0 bottom-0"></div>
    <div
      class="absolute translate-x-[-50%] translate-y-[-50%] top-[50%] left-[50%] flex flex-col items-center justify-center"
    >
      <div class="relative max-w-[500px] bg-[#EBFF00] p-[30px] rounded-[10px]">
        <h1 class="mb-[30px] text-[24px]">Форма для ввода данных аудитории</h1>
        <button
          @click="$emit('handleCloseModal')"
          class="absolute right-[10px] text-[24px] top-[10px]"
        >
          X
        </button>
        <form
          @submit.prevent="submitAuditorium"
          class="flex-col flex gap-[20px]"
        >
          <div class="flex flex-col">
            <label for="name">Название:</label>
            <input type="text" id="name" v-model="form.name" required />
          </div>
          <div class="flex flex-col">
            <label for="description">Описание:</label>
            <textarea
              id="description"
              v-model="form.description"
              required
            ></textarea>
          </div>
          <div class="flex flex-col">
            <label for="floor">Этаж:</label>
            <input
              type="number"
              id="floor"
              v-model.number="form.floor"
              required
            />
          </div>
          <div class="flex flex-col">
            <label for="phone">Телефон:</label>
            <input type="tel" id="phone" v-model="form.phone" required />
          </div>
          <div class="flex flex-col">
            <label for="capacity">Количество мест:</label>
            <input
              type="number"
              id="capacity"
              v-model.number="form.capacity"
              required
            />
          </div>
          <button class="bg-[#1FDB0E] p-[5px] text-white" type="submit">
            Добавить
          </button>
        </form>
      </div>
    </div>
  </div>
</template>
<style scoped>
div .wrapper {
  background: rgba(0, 0, 0, 0.5);
}
</style>
