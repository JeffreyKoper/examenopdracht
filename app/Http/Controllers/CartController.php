<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartpage()
  {
    $cart = Cart::all();
    return view('cart', ['cart' => $cart]); 
  }
}
