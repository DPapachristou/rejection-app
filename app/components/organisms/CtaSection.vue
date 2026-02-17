<template>
  <div class="bg-brand-gray text-white py-5 px-5 text-center gap-10 flex flex-col items-center">
    <img src="/icons/outside-comfort-zone.svg" alt="Falling-Logo" class="w-80 h-80" />
    <span class="text-2xl text-white/40 block">Rejected by one of these companies <br/> — or any other — <br/>and still don’t know why?</span>
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