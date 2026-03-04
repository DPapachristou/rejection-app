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
       @update:modelValue="field.id === 'country' ? handleCountryChange($event) : null"
       :error="errors[field.id]"
       v-model="field.value"
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
import { useWizardStore } from '~/stores/wizard';  
import Button from '~/components/atoms/Button.vue';
import { getParamByISO } from 'iso-country-currency';
import countries from 'i18n-iso-countries';

const wizardStore = useWizardStore();
const fields = computed(() => wizardStore.getCurrentStepFields);
const currentStep = computed(() => wizardStore.getWizardCurrentStep);
const stepData = computed(() => wizardStore.getWizardStepData);
const errors = ref({});

const handleCountryChange = (countryName) => {
  const countryCode = countries.getAlpha2Code(countryName, 'en');
  
  if (countryCode) {
    const currency = getParamByISO(countryCode, 'currency');
    
    wizardStore.setFieldValue('Salary & Benefits', 'currency', currency);
  }
};

const handleNext = () => {
  errors.value = {};

  let isValid = true;

  fields.value.forEach(field => {
    if (field.required && !field.value) {
      errors.value[field.id] = 'This field is required';
      isValid = false;
    }
  });

  if (isValid) {
  wizardStore.setWizardCurrentStep('Hiring Process');
  }
};

</script>