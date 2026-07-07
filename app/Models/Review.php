<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 
        'course_id', 
        'rating', 
        'comment', 
        'instructor_reply', 
        'replied_at'
    ];

    protected $casts = [
        'replied_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
