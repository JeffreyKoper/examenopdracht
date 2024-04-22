jQuery(document).ready(function ($) {
    $("#applyPromotionButton").click(function () {
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
                } else {
                    $("#promotionError")
                        .text("Invalid promo code. Please try again.")
                        .css("color", "red");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                $("#promotionError")
                    .text("An error occurred. Please try again later.")
                    .css("color", "red");
            },
        });
    });
});
