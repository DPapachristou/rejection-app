<template>
    <div class="w-full md:w-[500px]">
    <component :is="wizardComponentToShow"/>
    </div>
</template>

<script setup>
import { useWizardStore } from '../../stores/wizard.js';
import WizardRoleContext from '../molecules/Wizard/WizardRoleContext.vue';  
import WizardHiringProcess from '../molecules/Wizard/WizardHiringProcess.vue';
import WizardSalaryBenefits from '../molecules/Wizard/WizardSalaryBenefits.vue';
import WizardJobDescription from '../molecules/Wizard/WizardJobDescription.vue';
import WizardYourImpression from '../molecules/Wizard/WizardYourImpression.vue';

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