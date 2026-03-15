<template>
    <h3 class="text-4xl text-white">{{ currentStep }}</h3>
    <span class="text-xl text-white/40">{{ stepData?.description }}</span>
    <img :src="stepData?.icon" alt="Quote-Logo" class="w-25 h-25" />
<div class="w-full bg-gray-200 rounded-full dark:bg-white/20">
      <div class="bg-green-600 h-2.5 rounded-full" style="width: 100%"></div>
</div>
<div class="flex flex-col w-full">
    <div v-for="field in fields" :key="field.id" class="w-full py-5">
      <label 
      class="block mb-2 text-lg font-large text-gray-900 dark:text-white text-left"
    >
        {{ field.label }}   
       </label>
       <Input 
       v-model="field.value"
       :placeholder="field.placeholder" 
       :type="field.type"
       :option="field.options"
       />
</div>

</div>
<div class="flex flex-row items-center justify-between w-full">
<Button @click="handlePrevious" class="self-start mt-5" is-back-button="true">Previous Step</Button>
<Button @click="handleNext" class="self-end mt-5" :disabled="isLoading">Complete</Button>
</div>
</template>

<script setup>
import Input from '~/components/atoms/Input.vue';
import { useWizardStore } from '~/stores/wizard';
import { useWizard } from '~/composables/useWizard';
import Button from '~/components/atoms/Button.vue';
import { computed, ref } from 'vue';

const isLoading = ref(false)
const wizardStore = useWizardStore();
const { submitWizard } = useWizard();
const fields = computed(() => wizardStore.getCurrentStepFields);
const currentStep = computed(() => wizardStore.getWizardCurrentStep);
const stepData = computed(() => wizardStore.getWizardStepData);

const router = useRouter()

const handleNext = async () => {
  isLoading.value = true
    
  try {
    const result = await submitWizard(wizardStore.fields)
    router.push(`/processing/${result.id}`)
  } catch (error) {
    console.error('Submit error:', error)
    router.push('/error')
  } finally {
    isLoading.value = false
  }
}

const handlePrevious = () => {
  wizardStore.setWizardCurrentStep('Job Description');
};
</script>