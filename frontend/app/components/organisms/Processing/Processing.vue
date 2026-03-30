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
import { watch } from 'vue'
import { useWizardStore } from '~/stores/wizard'

const router = useRouter()
const wizardStore = useWizardStore()

// If navigated here without a pending submission, redirect home
if (!wizardStore.submissionStatus || wizardStore.submissionStatus === 'done') {
  router.replace('/')
}

watch(
  () => wizardStore.submissionStatus,
  (status) => {
    if (status === 'done') {
      const resultId = wizardStore.submissionResult.id

      wizardStore.$reset()

      router.push(`/results/${resultId}`)
    } else if (status === 'error') {

      wizardStore.$reset()
      
      router.push('/error')
    }
  },
  { immediate: true }
)
</script>