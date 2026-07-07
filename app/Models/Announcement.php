<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'target_role',
        'is_active',
        'starts_at',
        'ends_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
