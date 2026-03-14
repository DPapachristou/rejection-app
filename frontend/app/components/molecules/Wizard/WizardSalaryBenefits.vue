<template>
    <h3 class="text-4xl text-white">{{ currentStep }}</h3>
    <span class="text-xl text-white/40">{{ stepData?.description }}</span>
    <img :src="stepData?.icon" alt="Quote-Logo" class="w-25 h-25" />
<div class="w-full bg-gray-200 rounded-full dark:bg-white/20">
      <div class="bg-green-600 h-2.5 rounded-full" style="width: 60%"></div>
</div>
  <div class="flex flex-col w-full">
    <div v-for="field in fields" :key="field.id" class="w-full py-5">
      <label 
      class="block mb-2 text-lg font-large text-gray-900 dark:text-white text-left"
    >
        {{ field.label }}   
       </label>
       <Input
       :error="errors[field.id]"
       v-model="field.value"
       :placeholder="field.placeholder" 
       :type="field.type"
       :option="field.options"
       />
       <p v-if="errors[field.id]" class="mt-1 text-md text-red-200 text-left">
       {{ errors[field.id] }}
       </p>
  </div>
</div>
<div class="flex flex-row items-center justify-between w-full">
<Button @click="handlePrevious" class="self-start mt-5" is-back-button="true">Previous Step</Button>
<Button @click="handleNext" class="self-end mt-5">Next Step</Button>
</div>
</template>

<script setup>
import Input from '~/components/atoms/Input.vue';
import { useWizardStore } from '~/stores/wizard';  
import Button from '~/components/atoms/Button.vue';

const wizardStore = useWizardStore();
const fields = computed(() => wizardStore.getCurrentStepFields);
const currentStep = computed(() => wizardStore.getWizardCurrentStep);
const stepData = computed(() => wizardStore.getWizardStepData);
const errors = ref({});

const handleNext = () => {
  errors.value = {};

  let isValid = true;

  const salaryDiscussedField = fields.value.find(f => f.id === 'salary discussed');
  const isSalaryYes = salaryDiscussedField?.value === 'Yes';

  if (salaryDiscussedField?.value === 'No') {
      isValid = true;
  }

  fields.value.forEach(field => {
    if (field.required && !field.value) {
      errors.value[field.id] = 'This field is required';
      isValid = false;
    }

    const conditionalFields = ['currency', 'amount', 'period', 'salaryType'];

    if (isSalaryYes && conditionalFields.includes(field.id) && !field.value) {
      errors.value[field.id] = 'Please fill this field since salary was discussed';
      isValid = false;
    }
    if (field.validationType === 'number') {
        if (field.value && isNaN(field.value)) {
          errors.value[field.id] = 'Please enter a valid number';
          isValid = false;
        }
    }
  });

  if (isValid) {
  wizardStore.setWizardCurrentStep('Job Description');
  }
};

const handlePrevious = () => {
  wizardStore.setWizardCurrentStep('Hiring Process');
};
</script>