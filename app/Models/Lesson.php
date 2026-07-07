<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'section_id',
        'title',
        'video_url',
        'content',
        'quiz_duration',
        'quiz_max_warnings',
        'quiz_passing_score',
        'is_free_preview',
        'order_index'
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function quizQuestions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
}
