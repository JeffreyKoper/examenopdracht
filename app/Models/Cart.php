<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';


    public function products()
    {
        return $this->belongsToMany(Products::class, 'product_cart', 'cart_id', 'product_id')->withPivot('amount');
    }
}
