<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'product_cart', 'product_id', 'cart_id')->withPivot('amount', 'product_cart_price');
    }
}
