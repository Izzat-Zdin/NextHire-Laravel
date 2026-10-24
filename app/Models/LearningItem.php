<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'skill',
        'type',
        'level',
        'duration',
        'priority',
        'is_completed',
        'is_saved',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'is_saved' => 'boolean',
    ];
}
