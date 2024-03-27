<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $table = 'reviews';

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
