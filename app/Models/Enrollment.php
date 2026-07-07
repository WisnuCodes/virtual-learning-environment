<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'user_id',
        'course_id',
        'price_paid',
        'status',
        'payment_method',
        'payment_proof',
        'paid_at',
        'midtrans_snap_token',
        'midtrans_order_id',
        'midtrans_payment_type',
        'midtrans_transaction_status',
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
