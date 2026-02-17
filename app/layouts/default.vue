<template>
  <div class="bg-brand-gray flex flex-col items-center">
    <span class="py-4 text-white">WhyRejected Logo</span>
    <div class="w-3/4 h-px bg-gray-500/40"></div>
    <slot />
    <div class="w-3/4 h-px bg-gray-500/40"></div>
    <div class="flex flex-row justify-between items-center w-3/4">
    <span class="py-4 text-white">WhyRejected Logo</span>
    <div class="flex flex-row gap-2 items-center">
      <img src="/icons/registered-trademark.svg" alt="trademark" class="w-4 h-4 fill-white" />
      <span class="py-4 text-white">All rights reserved</span>
    </div>
    </div>
  </div>
</template>

<script setup>

</script>