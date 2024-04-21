<script setup>
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import ConformPopup from "./ConformPopup.vue";
defineProps({
  visible: Boolean,
  id: String,
});
const showConfirmation = ref(false);
const showDenyPopup = ref(false);
const handleConformPopup = () => {
  showConfirmation.value = true;
};
const handleDenyPopup = () => {
  showDenyPopup.value = true;
};
const value = ref("");
const emit = defineEmits(["handleCloseDenyPopup"]);
const handleSendEmail = (id) => {
  Inertia.post(route("audit-panel/deny-message", id), { reason: value.value });
};
const handleDeleteBooking = (id)=>{
    
}
</script>
<template>
  <div v-if="visible" class="">
    <div
      class="wrapper bg-black bg-opacity-50 absolute left-0 right-0 top-0 bottom-0"
    ></div>
    <ConformPopup
      :show-confirmation="showConfirmation"
      text="Ваша заявка успешно отклонена"
    />
    <div
      class="absolute translate-x-[-50%] translate-y-[-50%] top-[50%] left-[50%] flex flex-col items-center justify-center"
    >
      <div class="relative max-w-[500px] bg-[#EBFF00] p-[30px] rounded-[10px]">
        <h1 class="mb-[30px] text-[24px]">Объясните причину отказа</h1>
        <div class="text-center">
          <textarea
            placeholder="Объясните причину своего отказа"
            name=""
            id=""
            class="rounded-[10px]"
            cols="50"
            rows="10"
            v-model="value"
          ></textarea>
        </div>
        <button
          @click="$emit('handleCloseDenyPopup')"
          class="absolute right-[10px] text-[24px] top-[10px]"
        >
          X
        </button>
        <form class="flex-col flex gap-[20px]">
          <button
            @click="handleSendEmail(id), handleConformPopup()"
            class="bg-[#1FDB0E] p-[5px] text-white"
            type="button"
          >
            Отправить
          </button>
        </form>
      </div>
    </div>
  </div>
</template>
