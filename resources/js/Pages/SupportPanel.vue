<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { computed, ref } from "vue";
const page = usePage();
const bookings = ref(page.props.booking);
const userName = ref(page.props.userName.name);
const verifieData = computed(() => {
  return bookings.value.filter(
    (booking) => booking.verified && booking.technical_support
  );
});
</script>
<template>
  <div class="max-w-[1470px] p-[15px] m-auto">
    <Head title="support панель" />

    <AuthenticatedLayout :name="userName" />
    <div class="mt-[40px] flex flex-col justify-center items-center">
      <h2 class="text-white text-[28px] mb-[40px]">
        Список заявок для технического сопровождения
      </h2>
      <table>
        <thead>
          <tr>
            <th>Аудитория</th>
            <th>Время начало</th>
            <th>Время окончания</th>
            <th>Необходимость тех.сопровождения</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="booking in verifieData" :key="booking.id">
            <td>
              {{ booking.auditorium_name }}
            </td>
            <td>
              {{ booking.time.split("-")[0] }}
            </td>
            <td>
              {{ booking.time.split("-")[1] }}
            </td>
            <td>
              {{ booking.technical_support ? "Да" : "" }}
            </td>
          </tr>
        </tbody>
      </table>
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
