<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = ['lesson_id', 'title', 'description', 'grading_criteria', 'max_score', 'due_date', 'attachment'];

    protected $casts = [
        'grading_criteria' => 'array',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
}
