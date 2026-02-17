<template>
  <div class="bg-brand-gray text-white py-20 px-10 gap-7 flex flex-col items-center w-full">
    <div class="flex flex-row gap-15 items-start justify-between w-full max-w-6xl">
    <div class="flex flex-col">
      <h3 class="text-4xl">Don’t worry.</h3>
      <h3 class="text-green-500 text-5xl">We’ve got you!</h3>
      <img src="/icons/about-our-team.svg" alt="Join-Us-Logo" class="w-100 h-100" />
    </div>
    <div class="flex flex-col mt-10">
      <div class="flex flex-row gap-5 items-start mb-10">
        <img src="/icons/image 1001.png" alt="">
        <div class="flex flex-col gap-2">
        <span class="font-bold">You share your job application details</span>
        <span class="text-white/40 max-w-md">Role,  interview questions, job description, CV , salary, feedback - or even silence.</span>
        </div>
      </div>
      <div class="flex flex-row gap-5 items-start mb-10">
        <img src="/icons/image 1060.png" alt="">
        <div class="flex flex-col gap-2">
        <span class="font-bold">We analyze what went wrong</span>
        <span class="text-white/40 max-w-md">Our AI finds the most likely reasons behind the rejection.</span>
        </div>
      </div>
      <div class="flex flex-row gap-5 items-start">
        <img src="/icons/image 632.png" alt="">
        <div class="flex flex-col gap-2">
        <span class="font-bold">You get clear, actionable feedback</span>
        <span class="text-white/40 max-w-md">Concrete insights you can act on before your next application.</span>
        </div>
      </div>
    </div>
    </div>
    <Button class="self-center"
    @click="handleNavigation"
    >Get Your Answer!
  </Button>
  </div>
      
</template>

<script setup>
import Button from '~/components/atoms/Button.vue'

function handleNavigation() {
  window.location.href = '/wizard';
}
</script>