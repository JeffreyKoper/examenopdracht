jQuery(document).ready(function ($) {
    $("#applyPromotionButton").click(function () {
        // Disable the apply code button to prevent multiple clicks
        $(this).prop("disabled", true);

        var promoCode = $("#promotionCode").val();
        $.ajax({
            type: "GET",
            url: "/check_promo_code",
            data: {
                promo_code: promoCode,
            },
            success: function (response) {
                if (response.valid) {
                    $("#promotionError")
                        .text("Promo code applied successfully!")
                        .css("color", "green");
                    $("#codePrice")
                        .text("Discount = " + response.percentage + "%")
                        .css("display", "block");

                    // Calculate the total price incl. tax
                    var totalPriceInclTax = parseFloat(
                        $("#total_price_tax")
                            .text()
                            .replace("Total price incl. tax: € ", "")
                            .replace(",", "")
                    );

                    // Check if discount is applied
                    var discountText = $("#codePrice").text();
                    var discount = 0;
                    if (discountText.includes("Discount")) {
                        discount = parseFloat(
                            discountText.split("=")[1].trim()
                        );
                    }

                    // Apply discount if it exists
                    var discountedTotalPrice =
                        totalPriceInclTax -
                        totalPriceInclTax * (discount / 100);

                    // Update the total price incl. tax with the discount applied
                    $("#total_price_tax").text(
                        "Total price incl. tax: € " +
                            discountedTotalPrice.toFixed(2)
                    );

                    // Disable the apply code button after a successful application
                    $("#applyPromotionButton").prop("disabled", true);
                } else {
                    $("#promotionError")
                        .text("Invalid promo code. Please try again.")
                        .css("color", "red");
                    $("#codePrice").css("display", "none"); // Hide the discount if promo code is invalid
                    $("#applyPromotionButton").prop("disabled", false);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                $("#promotionError")
                    .text("An error occurred. Please try again later.")
                    .css("color", "red");
                $("#codePrice").css("display", "none"); // Hide the discount if an error occurs
            },
        });
    });
});
