<template>
  <div class="w-full">
  <div class="mb-8 animate-[fadeSlideUp_0.5s_ease-out]">
    <h3 class="font-cinzel text-[28px] font-bold text-[#e8e0d4] mb-2 tracking-wide">{{ currentStep }}</h3>
    <p class="text-[15px] text-white/40 font-light leading-relaxed">{{ stepData?.description }}</p>
  </div>
  <Card glow size="full">
    <div class="flex flex-col">
      <div v-for="field in fields" :key="field.id" :class="style.formGroup">
        <label class="block text-xs font-medium text-white/40 mb-2 tracking-widest uppercase">
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
        <span v-if="errors[field.id]" :class="style.errorMessage">
          <span>✦</span> {{ errors[field.id] }}
        </span>
      </div>
    </div>

      <div class="flex justify-between items-center mt-3 pt-6 border-t border-[rgba(212,168,83,0.12)]">
      <div></div>
      <Button @click="handleNext">Continue →</Button>
      </div>
  </Card>
  </div>
</template>

<script setup>
import Input from '~/components/atoms/Input.vue';
import { useWizardStore } from '~/stores/wizard';
import Card from '~/components/atoms/Card/Card.vue';
import Button from '~/components/atoms/Button.vue';
import { getParamByISO } from 'iso-country-currency';
import countries from 'i18n-iso-countries';

import style from './Wizard.module.scss';

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

watch(fields, (newFields) => {
    newFields.forEach(field => {
      if (field.value && errors.value[field.id]) {
        delete errors.value[field.id];
      }
    });
  },
  { deep: true }
);
</script>