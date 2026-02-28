<template>
    <h3 class="text-4xl text-white">{{ currentStep }}</h3>
    <span class="text-xl text-white/40">{{ stepData?.description }}</span>
    <img :src="stepData?.icon" alt="Quote-Logo" class="w-25 h-25" />
<div class="w-full bg-gray-200 rounded-full dark:bg-white/20">
      <div class="bg-green-600 h-2.5 rounded-full" style="width: 20%"></div>
</div>
<div class="flex flex-col w-full">
    <div v-for="field in fields" :key="field.id" class="w-full py-5">
      <label 
      class="block mb-2 text-lg font-large text-gray-900 dark:text-white text-left"
    >
        {{ field.label }}   
       </label>
       <Input 
       :placeholder="field.placeholder" 
       :type="field.type"
       :option="field.options"
       />
</div>

</div>

<Button @click="handleNext" class="self-end mt-5">Next Step</Button>
</template>

<script setup>
import Input from '~/components/atoms/Input.vue';
import { computed } from 'vue';
import { useWizardStore } from '~/stores/wizard';  
import Button from '~/components/atoms/Button.vue';

const wizardStore = useWizardStore();
const fields = computed(() => wizardStore.getCurrentStepFields);
const currentStep = computed(() => wizardStore.getWizardCurrentStep);
const stepData = computed(() => wizardStore.getWizardStepData);

wizardStore.setWizardCurrentStep(currentStep.value);

const handleNext = () => {
  wizardStore.setWizardCurrentStep('Hiring Process');
};

</script>