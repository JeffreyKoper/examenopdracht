@extends('layouts.default')
@section('content')
    <h1><b>My Cart</b></h1>
    <div class="container">
        @if (!empty($cartItems))
        <div class="cart-list">
            @foreach ($cartItems as $cartItem)
            <div class="cart-item">
                <img src="{{ $cartItem->img_filepath }}"  alt="product image">
                    <div class="cart-info">
                    <h1><b>{{ $cartItem->product_name }}</b></h1>
                    <h3>{{ $cartItem->excerpt }}</h3>
                    <h3 id="infoPrice_{{ $cartItem->id }}" class="infoPrice">€ <b>{{ number_format(($cartItem->pivot->amount * $cartItem->price),2) }}</b></h3>
                    <div class="cart-arrows">
                        <button type="button" data-item-price="{{ $cartItem->price }}" class="decrease" data-item-id="{{ $cartItem->id }}">-</button>
                        <h6 id="itemAmount_{{ $cartItem->id }}">{{ $cartItem->pivot->amount }}</h6>
                        <input type="hidden" name="product_id" value="{{ $cartItem->id }}">
                        <input type="hidden" name="product_stock_{{$cartItem->stock}}" id="ItemAmountStock_{{$cartItem->id}}" value="{{ $cartItem->stock }}">
                        <input type="hidden" name="products[{{ $cartItem->id }}]" id="itemAmountInput_{{ $cartItem->id }}" value="{{ $cartItem->pivot->amount }}">
                        <button type="button" data-item-price="{{ $cartItem->price }}" class="increase" data-item-id="{{ $cartItem->id }}">+</button>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <p>Your cart is empty.</p>
        @endif
        </div>
        @if (!empty($cartItems))  
        <div class="cart-summary">     
        <h2 name="total_price" id="totalPrice">Total price excl. tax: € {{ number_format($totalPrice, 2) }}</h2>
        <input type="hidden" name="totalPriceExcl" value="{{ number_format($totalPrice, 2) }}">
        <h2 name="shipping_price" id="shippingPrice">Shipping Tax € 0.00</h2>
        <input type="hidden" name="shippingPrice" value="">
        <h2 name="total_price_tax" id="total_price_tax">Total price incl. tax: € {{ number_format($totalPrice, 2) }}</h2>
        <input type="hidden" name="totalPriceIncl" value="">
        <h2><b>Select a Delivery Date</b></h2>
        <label for="deliveryDate">Delivery Date:</label>
        <input type="text" id="deliveryDate" name="delivery_date" required>
        <button type="submit" id="confirmOrderButton" style="display:none;"> Confirm order</button>
        @endif
    </div> 
    </div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="js/cart_script.js"></script>
@endsection