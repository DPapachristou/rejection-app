<template>
  <nav class="flex flex-row lg:flex-col gap-1 w-full lg:w-auto overflow-x-auto lg:overflow-visible py-2 lg:py-0">
    <div
      v-for="(step, index) in steps"
      :key="step.id"
      class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 shrink-0
             lg:flex-row flex-col text-center lg:text-left"
      :class="[
        step.id === currentStep && 'bg-white/[0.05]',
        isCompleted(index) && 'opacity-70',
      ]"
    >
      <div
        class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold border-[1.5px] transition-all duration-400 shrink-0"
        :class="[
          step.id === currentStep && 'border-[#d4a853] bg-[rgba(212,168,83,0.15)] text-[#d4a853] shadow-[0_0_20px_rgba(212,168,83,0.2)]',
          isCompleted(index) && step.id !== currentStep && 'border-[#8a6d2b] bg-[rgba(212,168,83,0.1)] text-[#d4a853]',
          !isCompleted(index) && step.id !== currentStep && 'border-[rgba(212,168,83,0.12)] text-white/25',
        ]"
      >
        <span v-if="isCompleted(index) && step.id !== currentStep">✓</span>
        <span v-else>{{ index + 1 }}</span>
      </div>
      <span
        class="text-[13px] transition-colors duration-300 hidden lg:inline"
        :class="[
          step.id === currentStep && 'text-[#e8e0d4] font-medium',
          isCompleted(index) && step.id !== currentStep && 'text-white/40',
          !isCompleted(index) && step.id !== currentStep && 'text-white/25',
        ]"
      >
        {{ step.id }}
      </span>
    </div>
  </nav>
</template>

<script setup>
import { useWizardStore } from '~/stores/wizard';

const wizardStore = useWizardStore();
const steps = computed(() => wizardStore.steps);
const currentStep = computed(() => wizardStore.getWizardCurrentStep);

const currentIndex = computed(() =>
  steps.value.findIndex(s => s.id === currentStep.value)
);

const isCompleted = (index) => index < currentIndex.value;
</script>