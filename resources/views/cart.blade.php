@extends('layouts.default')
@section('content')
<div class="container">
    <h1 class="checkout-heading">Checkout</h1>

    <div class="cart-products">
        <div class="cart-item">
            <h2 class="product-name">Product Name</h2>
            <h4 class="product-description">Product Description</h4>
            <img src="" alt="Image of Product" class="product-image">
            <h4 class="product-price">$ Price</h4>
        </div>
        <div class="cart-summary">
            <h2 class="summary-title">Order Summary</h2>
            @foreach ($cart as $data)
            @php
            $shipping = $data->total_price > 50 ? 0 : 50;
            $totalPriceIncludingShipping = $data->total_price + $shipping;
            @endphp
            <div class="summary-item">
                <span class="summary-label">Total price excl. shipping:</span>
                <span class="summary-value">$ {{number_format($data->total_price, 2)}}</span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Shipping:</span>
                <span class="summary-value">$ {{ number_format($shipping, 2)}}</span>
            </div>
            <div class="summary-item" style="display: none">
                <span class="summary-label">Discount:</span>
                <span class="summary-value">$ Discount</span>
            </div>
            <div class="summary-item total">
                <span class="summary-label">Total price incl. shipping:</span>
                <span class="summary-value">$ {{number_format($totalPriceIncludingShipping, 2)}}</span>
            </div>
            @endforeach
            <div class="delivery_form">
                <div class="boxHeader delivery_header">
                    <h2><b>Select a Pickup date</b></h2>
                </div>
                <div class="date_wrapper">
                    <label for="deliveryDate">Delivery Date:</label>
                    <input type="text" id="deliveryDate" name="delivery_date" required>
                    <div class="date_wrapper">
                        <button type="submit" class="button" id="confirmOrderButton" style="display:none;"> Confirm order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="js/cart_script.js"></script>
@endsection