<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'email', 'address', 'phone', 'country', 'city', 
        'payment_method', 'pincode', 'total', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
