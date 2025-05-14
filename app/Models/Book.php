<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'genre','price', 'image', 'description'];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
