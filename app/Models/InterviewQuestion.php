<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'question_no',
        'question_text',
        'question_type',
    ];

    public function session()
    {
        return $this->belongsTo(InterviewSession::class, 'session_id');
    }

    public function answers()
    {
        return $this->hasMany(InterviewAnswer::class, 'question_id');
    }
}
