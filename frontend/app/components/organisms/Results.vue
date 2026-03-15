<template>
  <div class="flex flex-col items-center justify-center w-1/2 gap-10 px-5 py-10 h-full">
    <h2 class="text-3xl text-white font-bold">Your Analysis</h2>
    <div class="bg-white/10 rounded-xl p-6 text-white whitespace-pre-wrap overflow-y-auto w-full max-h-[50vh] scrollbar-thin scrollbar-thumb-white/30 scrollbar-track-white/5 scrollbar-thumb-rounded-full scrollbar-track-rounded-full"
         v-html="analysis"/>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { marked } from 'marked'

const config = useRuntimeConfig()
const route = useRoute()
const router = useRouter()
const id = route.params.id

const analysis = ref(null)

onMounted(async () => {
  try {
    const result = await $fetch(`${config.public.apiBase}/api/wizard/submission/${id}`, {
      headers: { 'Accept': 'application/json' }
    })
    analysis.value = marked(result.analysis)
  } catch (error) {
    router.push('/error')
  }
})
</script>