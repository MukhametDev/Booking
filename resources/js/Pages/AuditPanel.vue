<script setup>
import { Head, Link, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { computed, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import Button from "@/Components/Button.vue";
import Moduledenial from "@/Components/Moduledenial.vue";
import ConformPopup from "@/Components/ConformPopup.vue";
const page = usePage();
const selectedBook = ref(null);
const showConfirmation = ref(false);
const showDenyPopup = ref(false);
const bookings = ref(page.props.data);
const booking_id = ref(0);
const handleCountenance = async (id) => {
  selectedBook.value = bookings.value.find((booking) => booking.id === id);

  try {
    await Inertia.put(route("auditPanel/update", id));
    // Вызываем sendApprovalEmail после успешного завершения Inertia.put
    sendApprovalEmail(id);
  } catch (error) {
    console.error("An error occurred during Inertia.put:", error);
  }
};

const sendApprovalEmail = (id) => {
  Inertia.post(route("audit-panel/approve-request", id));
};
const handleDenyPopup = (id) => {
  booking_id.value = id;
  showDenyPopup.value = true;
};
const handleCloseDenyPopup = () => {
  showDenyPopup.value = false;
};
const handleConformPopup = () => {
  showConfirmation.value = true;
};
const unverifiedData = computed(() => {
  return bookings.value.filter((booking) => !booking.verified);
});
</script>

<template>
  <div class="max-w-[1470px] p-[15px] m-auto">
    <Head title="auditManager панель" />
    <AuthenticatedLayout
      :name="$page.props.auth.audit.name"
      :email="$page.props.auth.audit.email"
    />
    <ConformPopup
      :show-confirmation="showConfirmation"
      :selected-book="selectedBook"
      text="Заявка успешно одобрена!"
    />
    <Moduledenial
      :id="booking_id"
      @handle-close-deny-popup="handleCloseDenyPopup"
      :visible="showDenyPopup"
    />
    <div class="mt-[30px] flex flex-col justify-center items-center">
      <h1 class="text-white text-[28px] mb-[80px]">
        Список заявок для бронирования
      </h1>
      <table>
        <thead>
          <tr>
            <th>Аудитория</th>
            <th>ФИО Бронирующего</th>
            <th>Время начало</th>
            <th>Время окончания</th>
            <th>Дата бронирования</th>
            <th>Необходимость тех. сопровождения</th>
            <th>Действие</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="booking in unverifiedData" :key="booking.id">
            <td>{{ booking.auditorium_name }}</td>
            <td>{{ booking.applicant_name }}</td>
            <td>{{ booking.time.split("-")[0] }}</td>
            <td>{{ booking.time.split("-")[1] }}</td>
            <td>{{ booking.date }}</td>
            <td>
              {{ Boolean(booking.technical_support) === true ? "Да" : "Нет" }}
            </td>
            <td class="flex gap-[10px] justify-center">
              <Button
                v-if="!booking.verified"
                @click="
                  handleCountenance(booking.id);
                  handleConformPopup();
                "
                styles="bg-[#33DB18] text-white p-[10px] rounded-[30px] cursor-pointer"
                text="Одобрить"
              ></Button>
              <Button
                @click="handleDenyPopup(booking.id)"
                v-if="!booking.verified"
                styles="bg-[#FF0000] text-white p-[10px] rounded-[30px] cursor-pointer"
                text="Отклонить"
              />
              <Button
                class="bg-[#33DB18]"
                v-if="booking.verified"
                text="Отклонено"
              ></Button>
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
