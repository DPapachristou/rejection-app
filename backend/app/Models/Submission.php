<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'role', 'industry', 'country', 'experience_level',
        'stage', 'feedback', 'notes',
        'salary_discussed', 'currency', 'period', 'salary_type', 'amount',
        'job_description', 'overall_impression',
    ];
}
