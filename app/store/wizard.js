import { defineStore } from "pinia";

export const useWizardStore = defineStore("wizard", {
  state: () => ({
    currentStep: null,

    steps: [
      {
        id: 1,
        title: "Step 1",
        description: "This is the first step of the wizard.",
      },
        {
        id: 2,
        title: "Step 2",
        description: "This is the second step of the wizard.",
        },
        {
        id: 3,
        title: "Step 3",
        description: "This is the third step of the wizard.",
        },
        {
        id: 4,
        title: "Step 4",
        description: "This is the fourth step of the wizard.",
        },
        {
        id: 5,
        title: "Step 5",
        description: "This is the fifth step of the wizard.",
        }
    ],
    fields: [
      { id: 'role', label: 'Role Title', placeholder: 'Enter Role Title', value: '', type: 'input' },
      { id: 'industry', label: 'Industry', placeholder: 'Enter Industry', value: '', type: 'input' },
      { id: 'country', label: 'Country', placeholder: 'e.g. United States', value: '', type: 'input' },
      {id: 'stage', label: 'Stage (select)', options: ['Phone Screening', 'HR Interview', 'Technical test or assessment' , 'Interview with hiring manager / team lead', 'Final interview - Senior Management', 'Offer'], value: '', type: 'dropdown' },
      {id: 'feedback', label: 'Feedback Received? (select)', options: ['Positive', 'Negative', 'Neutral', 'None'], value: '', type: 'dropdown' },
      {id: 'notes', label: 'If yes what specific feedback?', placeholder: 'Enter any additional notes or comments', value: '', type: 'textarea' },
    ]
  }),
  actions: {
    nextStep() {
      if (this.currentStep < this.steps.length) {
        this.currentStep++;
      }
    },
    previousStep() {
      if (this.currentStep > 1) {
        this.currentStep--;
      }
    },
    goToStep(stepId) {
      if (stepId >= 1 && stepId <= this.steps.length) {
        this.currentStep = stepId;
      }
    }
    },
    getters: {
      currentStepData(state) {
        return state.steps.find(step => step.id === state.currentStep);
      },
        isFirstStep(state) {
        return state.currentStep === 1;
      },
        isLastStep(state) {
        return state.currentStep === state.steps.length;
      },
    },
});
