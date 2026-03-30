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
       v-model="field.value"
       :placeholder="field.placeholder"
       :type="field.type"
       :option="field.options"
       />
</div>

    <div class="w-full py-5 flex flex-start items-start flex-col gap-4">
      <label class="block mb-2 text-lg font-large text-gray-900 dark:text-white text-left">
        Upload your CV/Resume (optional):
      </label>
      <input type="file" ref="fileInput" class="hidden" @change="handleFileChange" accept=".pdf,.doc,.docx" />
      <button @click="fileInput.click()" class="bg-white/20 text-white rounded-lg py-2 px-4 cursor-pointer w-full">
        Choose File
      </button>
      <span v-if="!cvFile" class="self-center text-white/40 text-sm ml-2">No file selected</span>
      <p v-if="cvFile" class="self-center mt-2 text-sm text-green-400">{{ cvFile.name }} selected</p>
      <p class="self-center mt-1 text-xs text-white/30">PDF, DOC, or DOCX — max 5MB</p>
    </div>
</div>
<div class="flex flex-row items-center justify-between w-full">
<Button @click="handlePrevious" class="self-start mt-5" is-back-button="true">Previous Step</Button>
<Button @click="handleNext" class="self-end mt-5">Next Step</Button>
</div>
</template>

<script setup>
import Input from '~/components/atoms/Input.vue';
import { computed, ref } from 'vue';
import { useWizardStore } from '~/stores/wizard';
import Button from '~/components/atoms/Button.vue';

const wizardStore = useWizardStore();
const fields = computed(() => wizardStore.getCurrentStepFields);
const currentStep = computed(() => wizardStore.getWizardCurrentStep);
const stepData = computed(() => wizardStore.getWizardStepData);
const fileInput = ref(null)
const cvFile = computed(() => wizardStore.cvFile)

const handleFileChange = (event) => {
  const file = event.target.files[0] || null
  wizardStore.setCvFile(file)
}

const handleNext = () => {
  wizardStore.setWizardCurrentStep('Your Impression');
};

const handlePrevious = () => {
  wizardStore.setWizardCurrentStep('Salary & Benefits');
};
</script>