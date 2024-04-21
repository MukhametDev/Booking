<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import AdminAuthenticated from "@/Layouts/AdminAuthenticated.vue";
import Users from "@/Pages/Users.vue";
import AdminPanel from "@/Pages/AdminPanel.vue";
import { useRouter, useRoute } from "vue-router";
import AdminPanelLayout from "@/Layouts/AdminPanelLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import ModalAuditorium from "@/Components/ModalAuditorium.vue";
import ModalAuditoriumButton from "@/Components/ModalAuditoriumButton.vue";
let visible = ref(false);
const page = usePage();
const auditoriums = ref(page.props.auditoriums);
const handleVisible = () => {
  visible.value = true;
};
const handleCloseModal = () => {
  visible.value = false;
};
</script>
<template>
  <div class="relative min-h-screen">
    <AdminPanelLayout />
    <div class="max-w-[1470px] p-[15px] m-auto">
      <ModalAuditoriumButton class="mb-[20px] flex justify-end items-end"  @click="handleVisible" />
      <div class="">
        <table>
          <thead>
            <tr>
              <th>название аудитории</th>
              <th>Описание</th>
              <th>Этаж</th>
              <th>Мест</th>
              <th>Телефон</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="auditorium in auditoriums">
              <td>{{ auditorium.name }}</td>
              <td>{{ auditorium.description }}</td>
              <td>{{ auditorium.floor }}</td>
              <td>{{ auditorium.capacity }}</td>
              <td>{{ auditorium.phone }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <ModalAuditorium
        @handle-close-modal="handleCloseModal"
        :visible="visible"
      />
    </div>
  </div>
</template>
<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid #ddd;
  text-align: center;
  border-radius: 10px;
}

/* Стили для заголовков столбцов */
th {
  padding: 8px;
  text-align: center;
  background-color: #f2f2f2;
  border: 1px solid rgb(74, 74, 74);
}

/* Стили для ячеек таблицы */
td {
  padding: 8px;
  text-align: center;
  background-color: #f2f2f2;
  border: 1px solid rgb(74, 74, 74);
}
tr {
  text-align: center;
}
/* Стили для четных строк */
tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
