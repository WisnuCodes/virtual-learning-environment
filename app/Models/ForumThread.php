<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    protected $fillable = ['user_id', 'category_id', 'title', 'slug', 'content', 'views', 'is_pinned', 'is_locked'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ForumCategory::class, 'category_id');
    }

    public function replies()
    {
        return $this->hasMany(ForumReply::class, 'thread_id');
    }
}
