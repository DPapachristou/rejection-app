<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RejectionAnalysisService
{
    public function analyze(array $data, ?UploadedFile $cvFile = null): string
    {
        $prompt = $this->buildPrompt($data, $cvFile !== null);
        $messages = $this->buildMessages($prompt, $cvFile);

        $client = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.openai.key'),
        ])->timeout(60);

        if (app()->environment('local')) {
            $client = $client->withoutVerifying();
        }

        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => $messages,
            'temperature' => 0.7,
            'max_tokens' => 1500,
        ]);

        $response->throw();

        return $response->json('choices.0.message.content');
    }

    private function buildMessages(string $prompt, ?UploadedFile $cvFile): array
    {
        $systemMessage = [
            'role' => 'system',
            'content' => 'You are a warm, supportive career coach speaking directly to the user. Address them as "you/your" throughout — never refer to them as "the candidate" or in third person. Be conversational, direct, and encouraging — like a trusted mentor, not a clinical report. Give actionable, specific advice. Respond in the same language as the data provided.',
        ];

        if ($cvFile === null) {
            return [
                $systemMessage,
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ];
        }

        $base64 = base64_encode(file_get_contents($cvFile->getRealPath()));
        $mimeType = $cvFile->getMimeType();

        $contentParts = [
            [
                'type' => 'text',
                'text' => $prompt,
            ],
            [
                'type' => 'file',
                'file' => [
                    'filename' => $cvFile->getClientOriginalName(),
                    'file_data' => "data:{$mimeType};base64,{$base64}",
                ],
            ],
        ];

        return [
            $systemMessage,
            [
                'role' => 'user',
                'content' => $contentParts,
            ],
        ];
    }

    private function buildPrompt(array $data, bool $hasCv): string
    {
        $parts = [
            "Here's the details about a job rejection. Speak directly to the user as their personal career coach:",
            "",
            "**Role:** {$data['role']}",
            "**Industry:** {$data['industry']}",
            "**Country:** {$data['country']}",
            "**Experience Level:** {$data['experience_level']}",
            "**Hiring Stage Reached:** {$data['stage']}",
            "**Feedback Received:** {$data['feedback']}",
        ];

        if (!empty($data['notes'])) {
            $parts[] = "**Additional Notes:** {$data['notes']}";
        }

        if ($data['salary_discussed'] === 'Yes' && !empty($data['amount'])) {
            $currency = $data['currency'] ?? '';
            $period = $data['period'] ?? '';
            $salaryType = $data['salary_type'] ?? '';
            $parts[] = "**Salary Discussed:** {$currency} {$data['amount']} {$salaryType} ({$period})";
        }

        if (!empty($data['job_description'])) {
            $parts[] = "**Job Description:** {$data['job_description']}";
        }

        if (!empty($data['overall_impression'])) {
            $parts[] = "**Your Overall Impression:** {$data['overall_impression']}";
        }

        $parts[] = "";
        $parts[] = "Structure your response as:";
        $parts[] = "1. **What likely went wrong** — explain to them what may have happened based on the stage, feedback, and context";
        $parts[] = "2. **What you can do next** — give them specific, actionable steps to improve";
        $parts[] = "3. **A closing pep talk** — remind them that rejection is part of the journey and encourage them to keep going";

        if ($hasCv) {
            $parts[] = "";
            $parts[] = "A CV/resume has been attached. Compare their CV/resume against the job description. Point out any skill gaps, missing keywords, or misalignments between their experience and what the role asked for. Weave this into your advice.";
        }

        return implode("\n", $parts);
    }
}
