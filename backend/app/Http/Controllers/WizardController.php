<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\Submission;
use App\Services\RejectionAnalysisService;

class WizardController extends Controller
{
    public function submit(Request $request, RejectionAnalysisService $analysisService)
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
            'cv'               => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $submission = Submission::create(collect($validated)->except('cv')->toArray());

        // Daily rate limit: 50 API calls per day
        $dailyKey = 'openai_calls:' . now()->format('Y-m-d');
        $dailyCalls = Cache::get($dailyKey, 0);

        if ($dailyCalls >= 50) {
            $submission->update(['analysis' => 'Daily analysis limit reached. Please try again tomorrow.']);

            return response()->json([
                'success'  => true,
                'id'       => $submission->id,
                'analysis' => $submission->analysis,
            ], 201);
        }

        try {
            $cvFile = $request->file('cv');
            $analysis = $analysisService->analyze($validated, $cvFile);
            $submission->update(['analysis' => $analysis]);
            Cache::put($dailyKey, $dailyCalls + 1, now()->endOfDay());
        } catch (\Throwable $e) {
            Log::error('OpenAI analysis failed for submission #' . $submission->id, [
                'error' => $e->getMessage(),
            ]);
            $submission->update(['analysis' => 'Analysis could not be generated at this time. Please try again later.']);
        }

        return response()->json([
            'success'  => true,
            'id'       => $submission->id,
            'analysis' => $submission->analysis,
        ], 201);
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
