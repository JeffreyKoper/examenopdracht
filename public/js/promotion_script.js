// Execute script when the DOM is ready
jQuery(document).ready(function ($) {
    // Add click event listener to the applyPromotionButton
    $("#applyPromotionButton").click(function () {
        // Disable the apply code button to prevent multiple clicks
        $(this).prop("disabled", true);

        // Get the promo code from the input field
        var promoCode = $("#promotionCode").val();

        // Perform AJAX request to check the promo code
        $.ajax({
            type: "GET",
            url: "/check_promo_code",
            data: {
                promo_code: promoCode,
            },
            success: function (response) {
                if (response.valid) {
                    // Display success message and apply discount
                    $("#promotionError")
                        .text("Promo code applied successfully!")
                        .css("color", "green");
                    $("#codePrice")
                        .text("Discount = " + response.percentage + "%")
                        .css("display", "block");

                    // Calculate discounted total price incl. tax
                    var totalPriceInclTax = parseFloat(
                        $("#total_price_tax")
                            .text()
                            .replace("Total price incl. tax: € ", "")
                            .replace(",", "")
                    );
                    var discountText = $("#codePrice").text();
                    var discount = 0;
                    if (discountText.includes("Discount")) {
                        discount = parseFloat(
                            discountText.split("=")[1].trim()
                        );
                    }
                    var discountedTotalPrice =
                        totalPriceInclTax -
                        totalPriceInclTax * (discount / 100);

                    // Update total price incl. tax with the discount applied
                    $("#total_price_tax").text(
                        "Total price incl. tax: € " +
                            discountedTotalPrice.toFixed(2)
                    );

                    // Disable the apply code button after successful application
                    $("#applyPromotionButton").prop("disabled", true);
                } else {
                    // Display error message for invalid promo code
                    $("#promotionError")
                        .text("Invalid promo code. Please try again.")
                        .css("color", "red");
                    $("#codePrice").css("display", "none"); // Hide the discount if promo code is invalid
                    $("#applyPromotionButton").prop("disabled", false);
                }
            },
            error: function (xhr, status, error) {
                // Handle AJAX errors
                console.error(xhr.responseText);
                $("#promotionError")
                    .text("An error occurred. Please try again later.")
                    .css("color", "red");
                $("#codePrice").css("display", "none"); // Hide the discount if an error occurs
            },
        });
    });
});
