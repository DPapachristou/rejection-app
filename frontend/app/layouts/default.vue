<template>
  <div class="bg-brand-gray flex flex-col items-center min-h-dvh">
    <img src="/icons/genielogo.svg" alt="Genie Logo" class="w-25 h-25" />
    <div class="w-3/4 h-px bg-gray-500/40"></div>
    <div class="flex-1 w-full flex flex-col items-center justify-center">
      <slot />
    </div>
    <div class="w-3/4 h-px bg-gray-500/40"></div>
    <div class="flex flex-row justify-between items-center w-3/4">
    <img src="/icons/genielogo.svg" alt="Genie Logo" class="w-25 h-25" />
    <div class="flex flex-row gap-2 items-center">
      <img src="/icons/registered-trademark.svg" alt="trademark" class="w-4 h-4" />
      <span class="py-4 text-white">RejectionGenie 2026</span>
    </div>
    </div>
  </div>
</template>

<script setup>

</script>