<script setup>
// import { Head, useForm, usePage } from "@inertiajs/vue3";
import Checkbox from "./Checkbox.vue";
import { reactive, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
defineProps({
  showModal: Boolean,
  date: String,
  time: String,
  auditoriumName: String,
  email: String,
});

const submitAuditorium = (newDate, newTime, newAuditorName, email) => {
  const formData = {
    auditoriumName: newAuditorName,
    date: newDate,
    time: newTime,
    email: email,
    ...form,
  };

  Inertia.post(route("auditPanel"), formData).then(() => {
    form.applicant_name = "";
    form.contact_phone = "";
    form.leader_name = "";
    form.technical_support = false;
  });
};
const form = reactive({
  applicant_name: "",
  contact_phone: "",
  technical_support: false,
  leader_name: "",
});
</script>

<template>
  <div v-if="showModal" class="">
    <div class="wrapper absolute left-0 right-0 top-0 bottom-0"></div>
    <div
      class="absolute translate-x-[-50%] translate-y-[-50%] top-[50%] left-[50%] flex flex-col items-center justify-center"
    >
      <div class="relative max-w-[500px] bg-[#EBFF00] p-[30px] rounded-[10px]">
        <h1 class="mb-[30px] text-[24px]">Форма для бронирования</h1>
        <button
          @click="$emit('close')"
          class="absolute right-[10px] text-[24px] top-[10px]"
        >
          X
        </button>
        <form
          @submit.prevent="submitAuditorium(date, time, auditoriumName, email)"
          class="flex-col flex gap-[20px]"
        >
          <div class="flex flex-col">
            <label for="name">Заявитель</label>
            <input
              autocomplete="off"
              type="text"
              id="name"
              v-model="form.applicant_name"
              required
            />
          </div>
          <div class="flex flex-col">
            <label for="phone">Контактный телефон</label>
            <input
              type="tel"
              id="phone"
              v-model="form.contact_phone"
              required
            />
          </div>
          <div class="flex flex-col">
            <label for="capacity">ФИО руководителя</label>
            <input
              type="text"
              id="capacity"
              v-model="form.leader_name"
              required
            />
          </div>
          <div class="">
            <label class="flex items-center">
              <Checkbox v-model="form.technical_support" name="remember" />
              <span class="ms-2 text-sm text-gray-600"
                >Необходимость технического сопровождения</span
              >
            </label>
          </div>
          <input type="hidden" name="date" :value="form.date" />
          <input type="hidden" name="time" :value="form.time" />

          <button class="bg-[#1FDB0E] p-[5px] text-white" type="submit">
            Отправить
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
