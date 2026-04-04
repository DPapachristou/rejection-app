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
      </div>

      <div class="flex justify-between items-center mt-3 pt-6 border-t border-[rgba(212,168,83,0.12)]">
        <Button @click="handlePrevious" is-back-button="true">← Previous</Button>
        <Button @click="handleNext">Summon the Genie</Button>
      </div>
    </Card>
  </div>
</template>

<script setup>
import Input from '~/components/atoms/Input.vue';
import { useWizardStore } from '~/stores/wizard';
import { useWizard } from '~/composables/useWizard';
import Button from '~/components/atoms/Button.vue';
import { computed } from 'vue';
import Card from '~/components/atoms/Card/Card.vue';

import style from './Wizard.module.scss';

const wizardStore = useWizardStore();
const { startSubmission } = useWizard();
const fields = computed(() => wizardStore.getCurrentStepFields);
const currentStep = computed(() => wizardStore.getWizardCurrentStep);
const stepData = computed(() => wizardStore.getWizardStepData);

const router = useRouter()

const handleNext = () => {
  startSubmission(wizardStore.fields)
  router.push('/processing')
}

const handlePrevious = () => {
  wizardStore.setWizardCurrentStep('Job Description');
};
</script>