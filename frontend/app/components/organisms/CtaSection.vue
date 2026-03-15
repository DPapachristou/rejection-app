<template>
  <div class="bg-brand-gray text-white py-5 px-5 text-center gap-15 flex flex-col items-center mb-20">
    <img src="/icons/outside-comfort-zone.svg" alt="Falling-Logo" class="w-80 h-80" />
    <Button
    @click="handleNavigation"
    >Get Your Answer!
  </Button>
  </div>
</template>

<script setup>
import Button from '~/components/atoms/Button.vue'

const handleNavigation = () => {
  navigateTo('/wizard');
}

</script>