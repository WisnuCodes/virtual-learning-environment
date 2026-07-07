<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'user_id',
        'badge_text',
        'emoji',
        'title',
        'message',
        'button_text',
        'button_link',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
