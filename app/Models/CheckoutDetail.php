<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'email', 'address', 'phone_number', 'country', 'city', 'payment_method', 'pin_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
