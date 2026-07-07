<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    protected $fillable = [
        'assignment_id',
        'user_id',
        'text_content',
        'file_path',
        'score',
        'criteria_scores',
        'feedback',
        'status'
    ];

    protected $casts = [
        'criteria_scores' => 'array',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
