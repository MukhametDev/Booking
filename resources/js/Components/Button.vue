<script setup>
const props = defineProps({
  text: String,
  styles: String,
});
</script>

<template>
  <button :class="props.styles">{{ props.text }}</button>
</template>
