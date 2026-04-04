<template>
  <div class="flex flex-col lg:flex-row lg:items-center lg:gap-12 w-full max-w-5xl mx-auto">
    <WizardProgress class="shrink-0"/>
    <div class="w-full lg:w-[700px]">
      <component :is="wizardComponentToShow" />
    </div>
  </div>
</template>

<script setup>
import { useWizardStore } from '../../stores/wizard.js';
import WizardRoleContext from '../molecules/Wizard/WizardRoleContext.vue';  
import WizardHiringProcess from '../molecules/Wizard/WizardHiringProcess.vue';
import WizardSalaryBenefits from '../molecules/Wizard/WizardSalaryBenefits.vue';
import WizardJobDescription from '../molecules/Wizard/WizardJobDescription.vue';
import WizardYourImpression from '../molecules/Wizard/WizardYourImpression.vue';
import WizardProgress from '../molecules/WizardProgress.vue';

const wizardStore = useWizardStore();
const currentStep = computed(() => wizardStore.getWizardCurrentStep);

const wizardComponentToShow = computed(() => ({
    'Role Context': WizardRoleContext,
    'Hiring Process': WizardHiringProcess,
    'Salary & Benefits': WizardSalaryBenefits,
    'Job Description': WizardJobDescription,
    'Your Impression': WizardYourImpression,
    }[currentStep.value]));

</script>