<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role',
        'interview_type',
        'difficulty',
        'total_questions',
        'current_question_no',
        'status',
        'average_score',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'average_score' => 'float',
    ];

    public function questions()
    {
        return $this->hasMany(InterviewQuestion::class, 'session_id')->orderBy('question_no');
    }

    public function answers()
    {
        return $this->hasMany(InterviewAnswer::class, 'session_id');
    }
}
