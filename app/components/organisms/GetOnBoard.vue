<template>
  <div class="bg-brand-gray text-white py-15 px-5 text-center gap-35 flex flex-row items-center justify-center">
    <div class="flex flex-col items-start text-left gap-16">
      <h3 class="text-4xl">Are you still curious?</h3>
      <span class="text-xl text-white/40 block">Let’s break down <br/>what really happened.</span>
      <Button
      @click="handleNavigation"
      >Get Your Answer!
    </Button>
    </div>
    <img src="/icons/business-presentation.svg" alt="Presentation-Logo" class="w-80 h-80" />
  </div>
</template>

<script setup>
import Button from '~/components/atoms/Button.vue'
const handleNavigation = () => {
  navigateTo('/wizard');
}
</script>