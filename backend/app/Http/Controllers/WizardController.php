<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class WizardController extends Controller
{
     public function submit(Request $request)
    {
        $validated = $request->validate([
            // Role Context
            'role'             => 'required|string|max:255',
            'industry'         => 'required|string|max:255',
            'country'          => 'required|string|max:255',
            'experience_level' => 'required|in:Entry Level,Mid Level,Senior Level,Executive',
            // Hiring Process
            'stage'    => 'required|string',
            'feedback' => 'required|in:Positive,Negative,Neutral,None',
            'notes'    => 'nullable|string',
            // Salary & Benefits
            'salary_discussed' => 'required|in:Yes,No',
            'currency'         => 'nullable|string|max:10',
            'period'           => 'nullable|in:Monthly,Yearly',
            'salary_type'      => 'nullable|in:Gross,Net',
            'amount'           => 'nullable|numeric|min:0',
            // Job Description
            'job_description'  => 'nullable|string',
            // Your Impression
            'overall_impression' => 'nullable|string',
        ]);

        $submission = Submission::create($validated);

        return response()->json([
            'success' => true,
            'id'      => $submission->id,
        ], 201);
    }
}
