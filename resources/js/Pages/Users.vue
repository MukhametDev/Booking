<script setup>
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import AdminPanelLayout from "@/Layouts/AdminPanelLayout.vue";
import { Inertia } from "@inertiajs/inertia";
const page = usePage();
const users = ref(page.props.users);
console.log(users);
const updateRole = async (userId, role) => {
  await Inertia.put(route("admin.users.updateRole", userId), { role });
};
</script>
<template>
  <AdminPanelLayout />
  <div class="max-w-[1470px] p-[15px] m-auto">
    <table>
      <thead>
        <tr>
          <th>Имя</th>
          <th>Email</th>
          <th>Роль</th>
          <th>Управление ролью</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users">
          <th>{{ user.name }}</th>
          <th>{{ user.email }}</th>
          <th>{{ user.role }}</th>
          <th>
            <Dropdown align="right" width="48">
              <template #trigger>
                <span class="inline-flex rounded-md">
                  <button
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                  >
                    Назначить роль
                    <svg
                      class="ms-2 -me-0.5 h-4 w-4"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </button>
                </span>
              </template>
              <template #content>
                <div class="flex flex-col p-[10px] gap-[5px]">
                  <DropdownLink
                    @click.prevent="updateRole(user.id, 'auditManager')"
                    class="border-b-[1px] border-black cursor-pointer border-solid"
                  >
                    Отвественный за аудитории
                  </DropdownLink>
                  <DropdownLink
                    @click.prevent="updateRole(user.id, 'user')"
                    as="button"
                    class="border-b-[1px] cursor-pointer border-black border-solid"
                  >
                    Обычный пользователь
                  </DropdownLink>
                  <DropdownLink
                    @click.prevent="updateRole(user.id, 'supportManager')"
                    as="button"
                    class="cursor-pointer"
                  >
                    Техническая поддержка
                  </DropdownLink>
                </div>
              </template>
            </Dropdown>
          </th>
        </tr>
      </tbody>
    </table>
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
