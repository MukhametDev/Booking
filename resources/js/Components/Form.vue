<script setup>
defineProps({
  showModal: Boolean,
  //   handleCloseModal: Function,
});
</script>
<template>
  <div v-if="showModal" class="">
    <div class="wrapper absolute left-0 right-0 top-0 bottom-0"></div>
    <div class="min-h-[100vh] relative max-w-[100%]">
      <div
        class="absolute p-[60px] rounded-[10px] bg-[#EBFF00] gap-[42px] items-center flex flex-col top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]"
      >
        <h2 class="text-[36px] bold relative">Форма подбора аудитории</h2>
        <form class="self-start flex flex-col gap-[20px]" action="">
          <input
            class="max-w-[100%] mb-[20px]"
            type="text"
            placeholder="Введите время начало"
          />
          <div class="flex flex-col">
            <label class="text-[24px] mb-[10px]" for="time"
              >Выберите срок бронирования</label
            >
            <select name="time" id="">
              <option value="08:30-10:00">08:30-10:00</option>
              <option value="10:15-11:45">10:15-11:45</option>
              <option value="12:00-13:30">12:00-13:30</option>
              <option value="14:00-15:30">14:00-15:30</option>
              <option value="15:45-17:15">15:45-17:15</option>
              <option value="17:30-19:00">17:30-19:00</option>
              <option value="19:10-20:40">19:10-20:40</option>
              <option value="20:50-22:10">20:50-22:10</option>
            </select>
          </div>
          <input type="text" placeholder="Укажите вместительность аудитории" />
        </form>
        <button
          type="submit"
          class="bg-[#1FDB0E] text-white text-[20px] rounded-[2px] py-[10px] px-[30px] max-w-[100%]"
        >
          Найти
        </button>
        <button
          @click="$emit('close')"
          type="submit"
          class="text-[30px] absolute top-[15px] right-[15px]"
        >
          X
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
div .wrapper {
  background: rgba(0, 0, 0, 0.5);
}
</style>
