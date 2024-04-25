@extends('layouts.default')
@section('content')
    <form action="{{ route('confirm_payment') }}" method="POST">
        @csrf
        <h1><b>My Cart</b></h1>
        <div class="container">
            @if (!empty($cartItems))
                <div class="cart-list">
                    @foreach ($cartItems as $cartItem)
                        <div class="cart-item">
                            <img src="{{ $cartItem->img_filepath }}" alt="product image">
                            <div class="cart-info">
                                @foreach ($productCart as $proCart)
                                    @if ($proCart->product_id == $cartItem->id)
                                        <button type="button" class="delete-button" data-item-id="{{ $proCart->id }}">X</button>
                                        @break
                                    @endif
                                @endforeach
                                <input type="hidden" class="cart-id" value="{{ $cart->id }}">
                                <h1><b>{{ $cartItem->product_name }}</b></h1>
                                <h3>{{ $cartItem->excerpt }}</h3>
                                <h3 id="infoPrice_{{ $cartItem->id }}" class="infoPrice">€ <b>{{ number_format(($cartItem->pivot->amount * $cartItem->price),2) }}</b></h3>
                                <div class="cart-arrows">
                                    <button type="button" data-item-price="{{ $cartItem->price }}" class="decrease" data-item-id="{{ $cartItem->id }}">-</button>
                                    <h6 id="itemAmount_{{ $cartItem->id }}">{{ $cartItem->pivot->amount }}</h6>
                                    <input type="hidden" name="product_id[]" value="{{ $cartItem->id }}">
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
                <h2 name="shipping_price" id="shippingPrice">Shipping Tax € 0.00</h2>
                <h3 name="code_price" id="codePrice" style="display: none">discount = </h2>
                <h2 name="total_price_tax" id="total_price_tax">Total price incl. tax: € {{ number_format($totalPrice, 2) }}</h2>       
                <h2><b>Select a Delivery Date</b></h2>
                <label for="deliveryDate">Delivery Date:</label>
                <input type="text" id="deliveryDate" name="delivery_date" required>
                <div class="promotion">
                    <label for="promotionCode">promo code:</label>
                    <input type="text" id="promotionCode" name="promotion_code">
                    <button type="button" id="applyPromotionButton">Apply Code</button>
                </div>
                <p class="disclaimer">*Only 1 promo code can be used per cart</p>
                <span id="promotionError" style="color: red;"></span>
                <button type="submit" id="confirmOrderButton" style="display:none;">Confirm order</button>
        @endif
            </div>  
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/cart_script.js"></script>
    <script src="js/promotion_script.js"></script>
    <script src="js/amount_script.js"></script>
    <script>
    // Handle delete button click event
    $(document).on('click', '.delete-button', function(e) {
        e.preventDefault();
        var itemId = $(this).data('item-id');
        if (confirm("Are you sure you want to delete this item?")) {
            // Perform AJAX request to delete the item
            $.ajax({
                url: "{{ url('/cart/delete') }}/" + itemId, // Update the URL to include the item ID
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Reload the page after successful deletion
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>

    
@endsection
