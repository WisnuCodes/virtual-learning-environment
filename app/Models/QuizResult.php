<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lesson_id',
        'score',
        'total_questions',
        'percentage',
        'answers_data',
        'is_force_submitted'
    ];

    protected $casts = [
        'answers_data' => 'array',
        'is_force_submitted' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
