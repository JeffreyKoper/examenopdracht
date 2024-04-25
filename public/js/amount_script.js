$(document).ready(function () {
    // Set up CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Decrease button click event
    $(".decrease").on("click", function () {
        var itemId = $(this).data("item-id");
        var cartId = $(".cart-id").val(); // Get the cart_id from the hidden input
        console.log("Cart ID:", cartId); // Log the cart_id to the console for debugging
        var itemAmountElement = $("#itemAmount_" + itemId);
        var currentAmount = parseInt(itemAmountElement.text());
        if (currentAmount > 1) {
            updateCartItem(itemId, cartId, currentAmount - 1);
        }
    });

    // Increase button click event
    $(".increase").on("click", function () {
        var itemId = $(this).data("item-id");
        var cartId = $(".cart-id").val(); // Get the cart_id from the hidden input
        console.log("Cart ID:", cartId); // Log the cart_id to the console for debugging
        var itemAmountElement = $("#itemAmount_" + itemId);
        var currentAmount = parseInt(itemAmountElement.text());
        var stock = parseInt($("#ItemAmountStock_" + itemId).val());
        if (currentAmount < stock) {
            updateCartItem(itemId, cartId, currentAmount + 1);
        }
    });

    // Function to update cart item via AJAX
    // Function to update cart item via AJAX
    function updateCartItem(itemId, cartId, newAmount) {
        $.ajax({
            url: "/update-cart-item",
            method: "POST",
            data: {
                item_id: itemId,
                cart_id: cartId,
                new_amount: newAmount,
            },
            success: function (response) {
                // Update the UI with the new amount or handle success accordingly
                if (response.success) {
                    $("#itemAmount_" + itemId).text(newAmount);
                    // Update the count in the navbar
                    updateNavbarProductCount(response.product_count);
                } else {
                    // Handle error response
                    console.log(response.message);
                }
            },
            error: function (xhr, status, error) {
                // Handle AJAX errors
                console.error(xhr.responseText);
            },
        });
    }

    // Function to update the count in the navbar
    function updateNavbarProductCount(count) {
        $(".cart-count").text(count);
    }
});
