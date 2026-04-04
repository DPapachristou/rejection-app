<template>
  <div class="w-full">
    <div class="mb-8">
      <h3 class="font-cinzel text-[28px] font-bold text-[#e8e0d4] mb-2 tracking-wide">
        {{ currentStep }}
      </h3>
      <p class="text-[15px] text-white/40 font-light leading-relaxed">
        {{ stepData?.description }}
      </p>
    </div>

    <Card glow size="full">
      <div class="flex flex-col">
        <div v-for="field in fields" :key="field.id" :class="style.formGroup">
          <label class="block text-xs font-medium text-white/40 mb-2 tracking-widest uppercase">
            {{ field.label }}
          </label>
          <Input
            v-model="field.value"
            :placeholder="field.placeholder"
            :type="field.type"
            :option="field.options"
          />
        </div>

        <!-- File Upload -->
        <div :class="style.formGroup">
          <label class="block text-xs font-medium text-white/40 mb-2 tracking-widest uppercase">
            Upload your CV/Resume (optional)
          </label>
          <input
            type="file"
            ref="fileInput"
            class="hidden"
            @change="handleFileChange"
            accept=".pdf,.doc,.docx"
          />
          <button
            @click="fileInput.click()"
            class="w-full py-3.5 px-4 rounded-xl text-left transition-all duration-300 cursor-pointer
                   bg-white/[0.04] border border-dashed border-[rgba(212,168,83,0.2)]
                   text-white/25 hover:border-[rgba(212,168,83,0.4)] hover:bg-white/[0.06]"
          >
            {{ cvFile ? cvFile.name : 'Choose file...' }}
          </button>
          <p v-if="cvFile" class="mt-2 text-xs text-green-400/80">
            <span>✦</span> {{ cvFile.name }} selected
          </p>
          <p class="mt-1.5 text-xs text-white/20">PDF, DOC, or DOCX — max 5MB</p>
        </div>
      </div>

      <div class="flex justify-between items-center mt-3 pt-6 border-t border-[rgba(212,168,83,0.12)]">
        <Button @click="handlePrevious" is-back-button="true">← Previous</Button>
        <Button @click="handleNext">Continue →</Button>
      </div>
    </Card>
  </div>
</template>

<script setup>
import Input from '~/components/atoms/Input.vue';
import { computed, ref } from 'vue';
import { useWizardStore } from '~/stores/wizard';
import Button from '~/components/atoms/Button.vue';
import Card from '~/components/atoms/Card/Card.vue';

import style from './Wizard.module.scss';

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