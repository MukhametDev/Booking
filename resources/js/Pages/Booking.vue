<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
import Form from "@/Components/Form.vue";
import ButtonChoice from "@/Components/ButtonChoice.vue";
import { onMounted, reactive, ref, watch } from "vue";
import axios from "axios";
import { usePage } from "@inertiajs/vue3";

let showModal = ref(false);
const handleShowModal = () => {
  showModal.value = true;
};
const handleCloseModal = () => {
  showModal.value = false;
};

// Используем usePage для получения данных, переданных из контроллера Laravel
const page = usePage();

// Создаем реактивную переменную для хранения данных
const auditoriums = ref(page.props.auditoriums);
console.log(auditoriums);
</script>

<template>
  <div class="wrapper">
    <Head title="Главная страница" />
    <Header />
    <AuthenticatedLayout
      :name="$page.props.auth.user.name"
      :email="$page.props.auth.user.email"
    >
      <ButtonChoice @click="handleShowModal" />
      <Form :show-modal="showModal" @close="handleCloseModal" />
    </AuthenticatedLayout>
    <div
      class="flex flex-col justify-center items-center mt-[200px] gap-[40px] mb-[40px]"
    >
      <h2 class="text-[28px] text-white">Список аудиторий</h2>
      <table>
        <thead>
          <tr>
            <th>Название аудитории</th>
            <th>Описание</th>
            <th>Этаж</th>
            <th>Мест</th>
            <th>Телефон</th>
            <!-- Другие заголовки столбцов, если нужно -->
          </tr>
        </thead>
        <tbody>
          <tr v-for="auditorium in auditoriums" :key="auditorium.id">
            <td class="cursor-pointer">
              <Link
                :href="
                  route('auditoriums', { auditoriumName: auditorium.name })
                "
                >{{ auditorium.name }}</Link
              >
            </td>
            <td>{{ auditorium.description }}</td>
            <td>{{ auditorium.floor }}</td>
            <td>{{ auditorium.capacity }}</td>
            <td>{{ auditorium.phone }}</td>
            <!-- Другие ячейки, если нужно -->
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<style scoped>
.wrapper {
  max-width: 1470px;
  margin: 0 auto;
  padding: 0 15px;
}
/* Стили для таблицы */
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
