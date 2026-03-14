<template>
  <div class="flex flex-col items-center justify-center min-h-screen gap-8 px-5">
    
    <div v-if="isLoading" class="flex flex-col items-center gap-4">
      <span class="text-white text-xl">Analyzing your interview...</span>
    </div>

    <div v-else class="flex flex-col items-center gap-6 max-w-2xl w-full">
      <h2 class="text-3xl text-white font-bold">Your Analysis</h2>
      <div class="bg-white/10 rounded-xl p-6 text-white whitespace-pre-wrap">
        {{ analysis }}
      </div>
      <Button @click="handleEmail">Send to my Email</Button>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import Button from '~/components/atoms/Button.vue'

const config = useRuntimeConfig()
const route = useRoute()
const id = route.params.id

const analysis = ref(null)
const isLoading = ref(true)
let interval = null

const fetchAnalysis = async () => {
  try {
    const result = await $fetch(`${config.public.apiBase}/api/wizard/submission/${id}`, {
      headers: { 'Accept': 'application/json' }
    })

    if (result.analysis) {
      analysis.value = result.analysis
      isLoading.value = false
      clearInterval(interval)
    }
  } catch (error) {
    clearInterval(interval)
    router.push('/error')
  }
}

onMounted(() => {
  fetchAnalysis() // ← αμέσως
  interval = setInterval(fetchAnalysis, 3000) // ← κάθε 3 δευτερόλεπτα
})

onUnmounted(() => {
  clearInterval(interval) // ← καθάρισε όταν φύγει το component
})

const handleEmail = () => {
  // θα το κάνουμε αργότερα
}
</script>