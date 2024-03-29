<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product_Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function create(Request $request)
    {
        $user = auth()->user();

        // Check if the user already has a cart
        $existingCart = Cart::where('user_id', $user->id)->where('payment_complete', 0)->first();

        if (!$existingCart) {
            // If no cart exists, create a new one
            $cart = new Cart();
            $cart->user_id = $user->id;
            $cart->save();
            $existingCart = Cart::where('user_id', $user->id)->where('payment_complete', 0)->first();;
        }

        // Zoek het product in het winkelwagentje van de gebruiker
        $existingProductCart = Product_Cart::where('cart_id', $existingCart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingProductCart) {
            // Als het product al in het winkelwagentje staat, update de hoeveelheid
            $existingProductCart->amount += $request->number;
            $existingProductCart->save();
        } else {
            // Als het product niet in het winkelwagentje staat, voeg een nieuw item toe
            $product_cart = new Product_Cart();
            $product_cart->product_id = $request->product_id;
            $product_cart->cart_id = $existingCart->id;
            $product_cart->amount = $request->number;
            $product_cart->save();
        }

        return redirect()->route('cart');}

        public function cartpage()
        {
            $userId = auth()->user()->id; // Get the id of a logged in user
        $cart = Cart::where('user_id', $userId)->where('payment_complete', 0)->first();  // Get the cart where the user_id is equal to the Id of the user
        $cart_id = Cart::select('id')->where('user_id', $userId)->where('payment_complete', 0)->first(); // get the cart_id of said cart where the user still needs to pay. 
        $product_cart = Product_Cart::where('cart_id', $cart_id)->first();
        $cartItems = $cart ? $cart->products : []; 

        // for the total price
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->pivot->amount * $cartItem->price;
        }

        return view('cart', ['cart' => $cart, 'cartItems' => $cartItems, 'product_cart' => $product_cart, 'totalPrice' => $totalPrice,]);
    }
    
}
