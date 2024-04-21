<script setup>
import { computed, ref } from "vue";
import { format } from "date-fns";
import { usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ModalBooking from "@/Components/ModalBooking.vue";
import { Head, Link } from "@inertiajs/vue3";
const page = usePage();
const tableData = ref([]);
const items = ["", "", "", "", "", "", ""];
const showModal = ref(false);
const date = ref("");
const time = ref("");
const email = ref(page.props.user_email);
const nameUser = ref(page.props.user_email.name);
const bookings = ref(page.props.booking);
const auditoriumName = computed(() => page.props.auditoriumName);
const bookingTheAuditorium = computed(() => {
  return bookings.value.filter(
    (booking) => booking.auditorium_name === auditoriumName.value
  );
});
const handleShowModal = (newTimeSlot, newDate) => {
  showModal.value = true;
  date.value = newDate;
  time.value = newTimeSlot;
};

const handleCloseModal = () => {
  showModal.value = false;
};

const timeSlots = [
  "08:30-10:00",
  "10:15-11:45",
  "12:00-13:30",
  "14:00-15:30",
  "15:45-17:15",
  "17:30-19:00",
  "19:10-20:40",
  "20:50-22:10",
];

generateTableData();

function generateTableData() {
  // Очистка текущих данных в таблице
  tableData.value = [];

  // Получение текущей даты и времени
  const currentDate = new Date();

  // Генерация данных для таблицы, например, на следующие 7 дней
  for (let i = 0; i < 7; i++) {
    const date = new Date(currentDate.getTime() + i * 24 * 60 * 60 * 1000); // Текущая дата + i дней
    const dateTimeString = `${format(date, "dd.MM.yyyy")}`;

    // Подготовка пустого слота для каждого времени в каждом дне
    const slots = {};
    timeSlots.forEach((slot) => {
      slots[slot] = { booked: false, userName: null }; // По умолчанию слот доступен и не забронирован
    });

    // Фильтрация бронирований по указанной аудитории
    const auditoriumBookings = bookingTheAuditorium.value.filter(
      (booking) => booking.date === dateTimeString
    );
    // Заполнение данных о бронировании для текущей даты и выбранной аудитории
    auditoriumBookings.forEach((booking) => {
      slots[booking.time].booked = true; // Устанавливаем флаг забронированности для слота
      slots[booking.time].userName = booking.leader_name; // Сохраняем имя пользователя, забронировавшего слот
    });

    // Добавление данных в таблицу
    tableData.value.push({ date: dateTimeString, slots });
  }
}
</script>
<template>
  <div class="max-w-[1470px] p-[15px] m-auto">
    <Head title="Список аудиторий" />
    <AuthenticatedLayout :route-name="booking" :name="nameUser" />
    <ModalBooking
      :auditorium-name="auditoriumName"
      :date="date"
      :time="time"
      :show-modal="showModal"
      :email="email"
      @close="handleCloseModal"
    />
    <!-- Ваш код -->
    <div class="mt-[50px]">
      <table>
        <thead>
          <tr>
            <th></th>
            <th v-for="(item, index) in tableData" :key="index">
              {{ item.date.replace(/\//g, ".") }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(timeSlot, timeIndex) in timeSlots" :key="timeIndex">
            <th>{{ timeSlot }}</th>
            <td
              class="cursor-pointer"
              v-for="(item, dayIndex) in tableData"
              :key="dayIndex"
              @click="
                !tableData[dayIndex].slots[timeSlot].booked &&
                  handleShowModal(timeSlot, tableData[dayIndex].date)
              "
            >
              <!-- Проверяем, есть ли бронирование для данного времени и даты -->
              <template v-if="tableData[dayIndex].slots[timeSlot].booked">
                <!-- Если есть, отображаем данные бронирования -->
                Забронировал аудиторию:
                {{ tableData[dayIndex].slots[timeSlot].userName }}
              </template>
              <template v-else>
                <!-- Если нет, показываем, что слот доступен -->
              </template>
            </td>
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
