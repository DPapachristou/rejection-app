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
import { onMounted, onUnmounted } from 'vue'

const config = useRuntimeConfig()
const route = useRoute()
const router = useRouter()
const id = route.params.id

let interval = null

const checkAnalysis = async () => {
  try {
    const result = await $fetch(`${config.public.apiBase}/api/wizard/submission/${id}`, {
      headers: { 'Accept': 'application/json' }
    })

    if (result.analysis) {
      clearInterval(interval)
      router.push(`/results/${id}`)
    }
  } catch (error) {
    clearInterval(interval)
    router.push('/error')
  }
}

onMounted(() => {
  interval = setInterval(checkAnalysis, 3000)
})

onUnmounted(() => {
  clearInterval(interval)
})
</script>