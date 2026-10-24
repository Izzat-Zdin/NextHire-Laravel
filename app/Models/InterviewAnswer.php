<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'question_id',
        'answer_text',
        'answer_method',
        'score',
        'duration_seconds',
    ];

    public function session()
    {
        return $this->belongsTo(InterviewSession::class, 'session_id');
    }

    public function question()
    {
        return $this->belongsTo(InterviewQuestion::class, 'question_id');
    }
}
