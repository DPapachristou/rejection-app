import { useWizardStore } from '~/stores/wizard'

export const useWizard = () => {
  const config = useRuntimeConfig()

  const submitWizard = async (fields) => {
    const wizardStore = useWizardStore()

    const payload = {
      // Role Context
      role:             fields['Role Context'].find(f => f.id === 'role')?.value,
      industry:         fields['Role Context'].find(f => f.id === 'industry')?.value,
      country:          fields['Role Context'].find(f => f.id === 'country')?.value,
      experience_level: fields['Role Context'].find(f => f.id === 'experience level')?.value,
      // Hiring Process
      stage:    fields['Hiring Process'].find(f => f.id === 'stage')?.value,
      feedback: fields['Hiring Process'].find(f => f.id === 'feedback')?.value,
      notes:    fields['Hiring Process'].find(f => f.id === 'notes')?.value,
      // Salary & Benefits
      salary_discussed: fields['Salary & Benefits'].find(f => f.id === 'salary discussed')?.value,
      currency:         fields['Salary & Benefits'].find(f => f.id === 'currency')?.value,
      period:           fields['Salary & Benefits'].find(f => f.id === 'period')?.value,
      salary_type:      fields['Salary & Benefits'].find(f => f.id === 'salaryType')?.value,
      amount:           fields['Salary & Benefits'].find(f => f.id === 'amount')?.value,
      // Job Description
      job_description:    fields['Job Description'].find(f => f.id === 'job description')?.value,
      // Your Impression
      overall_impression: fields['Your Impression'].find(f => f.id === 'overall impression')?.value,
    }

    const cvFile = wizardStore.cvFile

    if (cvFile) {
      const formData = new FormData()
      for (const [key, value] of Object.entries(payload)) {
        if (value != null) {
          formData.append(key, value)
        }
      }
      formData.append('cv', cvFile)

      const response = await $fetch(`${config.public.apiBase}/api/wizard/submit`, {
        method: 'POST',
        body: formData,
        headers: { 'Accept': 'application/json' }
      })
      return response
    }

    const response = await $fetch(`${config.public.apiBase}/api/wizard/submit`, {
      method: 'POST',
      body: payload,
      headers: { 'Accept': 'application/json' }
    })

    return response
  }

  const startSubmission = (fields) => {
    const wizardStore = useWizardStore()
    wizardStore.setSubmissionPending()

    submitWizard(fields)
      .then((result) => {
        wizardStore.setSubmissionDone(result)
      })
      .catch((error) => {
        wizardStore.setSubmissionError(error)
      })
  }

  return { submitWizard, startSubmission }
}
