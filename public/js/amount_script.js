$(document).ready(function () {
    // Set up CSRF token for AJAX requests
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Decrease button click event
    $(".decrease").on("click", function () {
        var decreaseButton = $(this);
        var increaseButton = decreaseButton.siblings(".increase");
        var itemId = decreaseButton.data("item-id");
        var cartId = $(".cart-id").val(); // Get the cart_id from the hidden input
        console.log("Cart ID:", cartId); // Log the cart_id to the console for debugging
        var itemAmountElement = $("#itemAmount_" + itemId);
        var currentAmount = parseInt(itemAmountElement.text());
        if (currentAmount > 1) {
            disableButtons(decreaseButton, increaseButton);
            updateCartItem(
                itemId,
                cartId,
                currentAmount - 1,
                enableButtons.bind(null, decreaseButton, increaseButton)
            );
        }
    });

    // Increase button click event
    $(".increase").on("click", function () {
        var increaseButton = $(this);
        var decreaseButton = increaseButton.siblings(".decrease");
        var itemId = increaseButton.data("item-id");
        var cartId = $(".cart-id").val(); // Get the cart_id from the hidden input
        console.log("Cart ID:", cartId); // Log the cart_id to the console for debugging
        var itemAmountElement = $("#itemAmount_" + itemId);
        var currentAmount = parseInt(itemAmountElement.text());
        var stock = parseInt($("#ItemAmountStock_" + itemId).val());
        if (currentAmount < stock) {
            disableButtons(increaseButton, decreaseButton);
            updateCartItem(
                itemId,
                cartId,
                currentAmount + 1,
                enableButtons.bind(null, increaseButton, decreaseButton)
            );
        }
    });

    // Function to update cart item via AJAX
    function updateCartItem(itemId, cartId, newAmount, callback) {
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
            complete: function () {
                if (typeof callback === "function") {
                    callback();
                }
            },
        });
    }

    // Function to update the count in the navbar
    function updateNavbarProductCount(count) {
        $(".cart-count").text(count);
    }

    // Function to disable buttons
    function disableButtons(button1, button2) {
        button1.prop("disabled", true);
        button2.prop("disabled", true);
    }

    // Function to enable buttons
    function enableButtons(button1, button2) {
        button1.prop("disabled", false);
        button2.prop("disabled", false);
    }
});
