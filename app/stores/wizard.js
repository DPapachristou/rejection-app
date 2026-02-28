import { defineStore } from "pinia";

export const useWizardStore = defineStore("wizard", {
  state: () => ({
    currentStep: 'Role Context',
    steps: [
        {
          id: 'Role Context',
          title: "Step 1",
          description: "Give us some context about the role you applied for.",
          icon: '/icons/Step1.svg',
        },
        {
          id: 'Hiring Process',
          title: "Step 2",
          description: "Tell us about the hiring process you went through.",
          icon: '/icons/Step2.svg',
        },
        {
          id: 'Salary & Benefits',
          title: "Step 3",
          description: "Share details about salary and benefits discussed.",
          icon: '/icons/Step3.svg',
        },
        {
          id: 'Job Description',
          title: "Step 4",
          description: "Share the job description you were applying for.",
          icon: '/icons/Step4.svg',
        },
        {
          id: 'Your Impression',
          title: "Step 5",
          description: "Share your overall impression of the company and the interview process.",
          icon: '/icons/Step5.svg',
        }
    ],
    fields: {
      'Role Context':[
      { id: 'role', label: 'Role Title:', placeholder: 'Enter Role Title', value: '', type: 'input' },
      { id: 'industry', label: 'Industry:', placeholder: 'Enter Industry', value: '', type: 'input' },
      { id: 'country', label: 'Country:', placeholder: 'e.g. United States', value: '', type: 'input' },
      { id: 'experience level', label: 'Experience Level:', placeholder: 'Select Experience Level', options: ['Entry Level', 'Mid Level', 'Senior Level', 'Executive'], value: '', type: 'select' },
      ],
      'Hiring Process': [
      { id: 'stage', label: 'Stage (select):', options: ['Phone Screening', 'HR Interview', 'Technical test or assessment' , 'Interview with hiring manager / team lead', 'Final interview - Senior Management', 'Offer'], value: '', type: 'dropdown' },
      { id: 'feedback', label: 'Feedback Received? (select)', options: ['Positive', 'Negative', 'Neutral', 'None'], value: '', type: 'dropdown' },
      { id: 'notes', label: 'If yes what specific feedback?', placeholder: 'Enter any additional notes or comments', value: '', type: 'textarea' },
      ],
      'Salary & Benefits': [
      { id: 'salary discussed', label: 'Did compensation come up? (yes/no)', options: ['Yes', 'No'], value: '', type: 'dropdown' },
      { id: 'currency', label: 'Currency:', placeholder: 'e.g. USD, EUR', value: '', type: 'input' },
      { id: 'period', label: 'Period (monthly/yearly): ', placeholder: 'Enter Benefits Offered', value: '', type: 'textarea' },
      { id: 'salaryType', label: 'Gross / Net:',  options: ['Gross', 'Net'], value: '', type: 'dropdown' },
      {id: 'amount', label: 'Please enter the requested amount:', placeholder: 'Enter Amount', value: '', type: 'input' },
      ],
      'Job Description': [
      { id: 'job description', label: 'Share the job ad description here:', placeholder: 'Enter Job Description', value: '', type: 'textarea' },
      ],
      'Your Impression': [
      { id: 'overall impression', label: 'Share your thoughts and impressions on the hiring process:', placeholder: 'Enter your overall impression of the company and the interview process', value: '', type: 'textarea' },
      ],
    }
  }),
  actions: {
    setWizardCurrentStep(stepId) {
      this.currentStep = stepId;
      }
    },
  getters: {
      getWizardCurrentStep(state) {
        return state.currentStep;
      },
      getWizardStepData(state) {
        return state.steps.find(step => step.id === state.currentStep);
      },
      getCurrentStepFields(state) {
        return state.fields[state.currentStep] || [];
      },  
    },
});
