<template>
    <div class="flex flex-col items-center justify-center w-full text-center gap-6 h-full">
    <h1 class="text-white text-3xl">Please wait while we are analyzing your data...</h1>
    <div :class="style.spinner">
      <div :class="style.bounce1"></div>
      <div :class="style.bounce2"></div>
      <div :class="style.bounce3"></div>
    </div>
    </div>

</template>

<script setup>
import style from './Processing.module.scss'


</script>