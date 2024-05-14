// Calculate total price
calcTotalPrice();

// Add event listener for delivery date change
document.getElementById("deliveryDate").addEventListener("change", function () {
    var confirmOrderButton = document.getElementById("confirmOrderButton");
    if (this.value !== "") {
        confirmOrderButton.style.display = "block";
    } else {
        confirmOrderButton.style.display = "none";
    }
});

// Add event listeners for increase buttons
var increaseButtons = document.getElementsByClassName("increase");
for (var i = 0; i < increaseButtons.length; i++) {
    increaseButtons[i].addEventListener("click", function () {
        increase(this.dataset.itemId, this.dataset.itemPrice);
    });
}

// Add event listeners for decrease buttons
var decreaseButtons = document.getElementsByClassName("decrease");
for (var i = 0; i < decreaseButtons.length; i++) {
    decreaseButtons[i].addEventListener("click", function () {
        decrease(this.dataset.itemId, this.dataset.itemPrice);
    });
}

// Function to calculate total price
function calcTotalPrice() {
    var totalPrice = 0;
    var infoPriceElements = document.getElementsByClassName("infoPrice");

    for (var i = 0; i < infoPriceElements.length; i++) {
        // Extract the product subtotal from the inner HTML
        var subtotalString = infoPriceElements[i].innerHTML
            .replace("€ ", "")
            .replace("<b>", "")
            .replace("</b>", "");

        // Convert the subtotal to a number
        var subtotal = parseFloat(subtotalString);

        // Add the product subtotal to the total price
        totalPrice += subtotal;
    }

    // Update total price elements
    var totalPrice_element = document.getElementById("totalPrice");
    var shipping_element = document.getElementById("shippingPrice");
    var totalPriceMax_element = document.getElementById("total_price_tax");

    totalPrice_element.innerHTML =
        "Total price excl. tax: € " + totalPrice.toFixed(2);

    // Calculate total price with tax and shipping
    var taxTotalPrice = totalPrice + 7.5;
    if (totalPrice >= 50) {
        taxTotalPrice = totalPrice;
        shipping_element.innerHTML = "Shipping Tax € 0.00";
        totalPriceMax_element.innerHTML =
            "Total price incl. tax: € " + taxTotalPrice.toFixed(2);
    } else if (totalPrice < 50) {
        shipping_element.innerHTML = "Shipping Tax € 7.50";
        taxTotalPrice = totalPrice + 7.5;
        totalPriceMax_element.innerHTML =
            "Total price incl. tax: € " + taxTotalPrice.toFixed(2);
    }

    // Apply discount if available
    var discountText = $("#codePrice").text();
    var discount = 0;
    if (discountText.includes("Discount")) {
        discount = parseFloat(discountText.split("=")[1].trim());
    }

    // Apply discount to total price
    var discountedTotalPrice = taxTotalPrice - taxTotalPrice * (discount / 100);
    totalPriceMax_element.innerHTML =
        "Total price incl. tax: € " + discountedTotalPrice.toFixed(2);

    // Reset animations
    totalPrice_element.style.animation = "none";
    shipping_element.style.animation = "none";
    totalPriceMax_element.style.animation = "none";

    // Trigger reflow
    totalPrice_element.offsetHeight;
    shipping_element.offsetHeight;
    totalPriceMax_element.offsetHeight;

    // Start animations
    totalPrice_element.style.animation = null;
    shipping_element.style.animation = null;
    totalPriceMax_element.style.animation = null;
}

// Increase item quantity
function increase(itemId, itemPrice) {
    var count_element = document.getElementById("itemAmount_" + itemId);
    var inputEl = document.getElementById("itemAmountInput_" + itemId);
    var stock = document.getElementById("ItemAmountStock_" + itemId);
    var maxCount = Number(stock.value);
    var count = Number(count_element.innerHTML);
    count += 1;
    if (count >= maxCount) {
        count = maxCount;
    }
    var infoPrice_element = document.getElementById("infoPrice_" + itemId);
    var sum = itemPrice * count;

    infoPrice_element.innerHTML = "€ " + "<b>" + sum.toFixed(2) + "</b>";

    inputEl.value = count; // Update hidden input field with new amount

    calcTotalPrice();
}

// Decrease item quantity
function decrease(itemId, itemPrice) {
    var count_element = document.getElementById("itemAmount_" + itemId);
    var inputEl = document.getElementById("itemAmountInput_" + itemId);
    var count = Number(count_element.innerHTML);
    count -= 1;
    if (count <= 1) {
        count = 1;
    }
    var infoPrice_element = document.getElementById("infoPrice_" + itemId);
    var sum = itemPrice * count;
    infoPrice_element.innerHTML = "€ " + "<b>" + sum.toFixed(2) + "</b>";
    inputEl.value = count; // Update hidden input field with new amount

    calcTotalPrice();
}

// Initialize flatpickr for delivery date selection
var tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);

flatpickr("#deliveryDate", {
    enableTime: false,
    dateFormat: "Y-m-d",
    minDate: tomorrow,
    maxDate: new Date().fp_incr(22),
    inline: true,
    weekNumbers: true,
    locale: {
        firstDayOfWeek: 1,
    },
    disable: [
        "2024-01-01", // New Year's Day
        "2024-03-29", // Good Friday
        "2024-03-31", // Easter Sunday
        "2024-04-01", // Easter Monday
        "2024-04-27", // King's Day
        "2024-05-05", // Liberation Day
        "2024-05-09", // Ascension Day
        "2024-05-20", // Whit Sunday
        "2024-07-01", // Keti Koti (Emancipation Day)
        "2024-12-25", // Christmas Day
        "2024-12-26", // Boxing Day
    ],
});
