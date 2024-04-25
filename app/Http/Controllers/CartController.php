<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product_Cart;
use App\Models\Products;
use App\Models\Promotions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function create(Request $request)
    {
        $user = auth()->user();
        $product = Products::find($request->product_id);

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
            $existingProductCart->product_cart_price = $product->price * ($request->number + 1);
            $existingProductCart->save();
        } else {
            // Als het product niet in het winkelwagentje staat, voeg een nieuw item toe
            $productCart = new Product_Cart();
            $productCart->product_id = $request->product_id;
            $productCart->cart_id = $existingCart->id;
            $productCart->amount = $request->number;
            $productCart->product_cart_price = $product->price * $request->number;
            $productCart->save();
        }

        return redirect()->route('cart');
    }

    public function cartpage()
    {
        $userId = auth()->user()->id; // Get the id of a logged in user
        $cart = Cart::where('user_id', $userId)->where('payment_complete', 0)->first();  // Get the cart where the user_id is equal to the Id of the user
        $cartId = Cart::select('id')->where('user_id', $userId)->where('payment_complete', 0)->first(); // get the cart_id of said cart where the user still needs to pay. 
        $productCart = Product_Cart::where('cart_id', $cartId)->first();
        $cartItems = $cart ? $cart->products : [];

        // for the total price
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem->pivot->amount * $cartItem->price;
        }

        return view('cart', ['cart' => $cart, 'cartItems' => $cartItems, 'product_cart' => $productCart, 'totalPrice' => $totalPrice,]);
    }

    public function confirmPayment(Request $request)
    {
        $userId = auth()->user()->id;

        // Check if a cart exists for the user
        $cart = Cart::where('user_id', $userId)->where('payment_complete', 0)->first();
        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        $syncData = [];

        foreach ($request->product_id as $productId) {
            $amount = $request->input('products.' . $productId);
            $syncData[$productId] = ['amount' => $amount];
        }

        // Sync products with updated quantities
        $cart->products()->sync($syncData);

        $products = $cart->products;

        $totalPrice = 0;

        foreach ($products as $product) {
            $amount = $product->pivot->amount; // Amount from pivot table
            $product->stock -= $amount; // Adjust stock

            // Recalculate price based on new amount
            $price = $product->price * $amount;

            // Update total price
            $totalPrice += $price;

            // Save changes to product
            $product->save();
        }

        // Check if the total price is less than 50 and adjust if necessary
        if ($totalPrice < 50) {
            $totalPrice += 50;
        }
        $promoCode = $request->promotion_code;
        $discountPercentage = 0;
        if ($promoCode) {
            // Retrieve the discount percentage based on the promo code
            $promotion = Promotions::where('code', $promoCode)->where('valid', true)->first();
            if ($promotion) {
                $discountPercentage = $promotion->percentage;
                $cart->code_used = $promotion->id; // Set the ID of the promo code used
                $promotion->uses -= 1;
                $promotion->save();
            }
        }

        // Apply discount to total price
        $discountedTotalPrice = $totalPrice - ($totalPrice * ($discountPercentage / 100));

        $discountedTotalPrice = round($discountedTotalPrice, 2);

        // Update cart details
        $cart->total_price = $totalPrice;
        $cart->delivery_date = $request->delivery_date;
        $cart->payment_complete = true;
        $cart->discounted_price = $discountedTotalPrice;
        $cart->save();

        // Now we've updated the total price and other details, let's update the product_cart_price for each product in the cart
        foreach ($products as $product) {
            // Get the amount of the product from the cart
            $amount = $product->pivot->amount;

            // Get the corresponding product_cart record
            $productCart = Product_Cart::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->first();

            // Recalculate the product_cart_price based on the current amount
            $productCart->product_cart_price = $product->price * $amount;

            // Save the changes to the product_cart
            $productCart->save();
        }

        return redirect()->route('dashboard');
    }

    public function updateCartItem(Request $request)
    {
        $itemId = $request->input('item_id');
        $cartId = $request->input('cart_id');
        $newAmount = $request->input('new_amount');

        // Update the cart item in the product_cart table
        $productCart = Product_Cart::where('product_id', $itemId)
            ->where('cart_id', $cartId)
            ->first();

        if (!$productCart) {
            return response()->json(['success' => false, 'message' => 'Cart item not found']);
        }

        $productCart->amount = $newAmount;
        $productCart->save();

        // Get updated product count
        $productCount = $this->getProductCountInCart();

        return response()->json(['success' => true, 'product_count' => $productCount]);
    }


    public function getProductCountInCart()
    {
        $userId = Auth::id(); // Get the id of the logged-in user
        $cartId = Cart::where('user_id', $userId)
            ->where('payment_complete', 0)
            ->value('id'); // Get the id of the cart where payment is not complete

        // If cartId is null, there are no products in the cart
        if (!$cartId) {
            return 0;
        }

        $productCount = Product_Cart::where('cart_id', $cartId)
            ->sum('amount'); // Sum of the amount of products in the cart

        return $productCount;
    }
}
