<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Submission;

class WizardController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'role'             => 'required|string|max:255',
            'industry'         => 'required|string|max:255',
            'country'          => 'required|string|max:255',
            'experience_level' => 'required|in:Entry Level,Mid Level,Senior Level,Executive',
            'stage'            => 'required|string',
            'feedback'         => 'required|in:Positive,Negative,Neutral,None',
            'notes'            => 'nullable|string',
            'salary_discussed' => 'required|in:Yes,No',
            'currency'         => 'nullable|string|max:10',
            'period'           => 'nullable|in:Monthly,Yearly',
            'salary_type'      => 'nullable|in:Gross,Net',
            'amount'           => 'nullable|numeric|min:0',
            'job_description'  => 'nullable|string',
            'overall_impression' => 'nullable|string',
        ]);

        $submission = Submission::create($validated);

        $this->triggerN8n($validated, $submission->id);

        return response()->json([
            'success' => true,
            'id'      => $submission->id,
        ], 201);
    }

    private function triggerN8n(array $data, int $submissionId): void
    {
        Http::post(env('N8N_WEBHOOK_URL'), [
            'submission_id' => $submissionId,
            'data'          => $data,
            'timestamp'     => now()->toISOString(),
        ]);
    }

    public function saveAnalysis(Request $request)
  {
    $validated = $request->validate([
        'submission_id' => 'required|integer|exists:submissions,id',
        'analysis'      => 'required|string',
    ]);

    $submission = Submission::findOrFail($validated['submission_id']);
    $submission->update(['analysis' => $validated['analysis']]);

    return response()->json(['success' => true], 200);
    }

    public function getSubmission($id)
    {
    $submission = Submission::findOrFail($id);

    return response()->json([
        'id'       => $submission->id,
        'analysis' => $submission->analysis,
    ], 200);
    }
}
