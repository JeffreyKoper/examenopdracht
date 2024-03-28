window.onload = calcTotalPrice();
document.getElementById("deliveryDate").addEventListener("change", function () {
    var confirmOrderButton = document.getElementById("confirmOrderButton");
    if (this.value !== "") {
        confirmOrderButton.style.display = "block";
    } else {
        confirmOrderButton.style.display = "none";
    }
});
// Get all elements with the class "increase" and add event listeners
var increaseButtons = document.getElementsByClassName("increase");
for (var i = 0; i < increaseButtons.length; i++) {
    increaseButtons[i].addEventListener("click", function () {
        increase(this.dataset.itemId, this.dataset.itemPrice);
    });
}

// Get all elements with the class "decrease" and add event listeners
var decreaseButtons = document.getElementsByClassName("decrease");
for (var i = 0; i < decreaseButtons.length; i++) {
    decreaseButtons[i].addEventListener("click", function () {
        decrease(this.dataset.itemId, this.dataset.itemPrice);
    });
}

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

        var totalPrice_element = document.getElementById("totalPrice");
        var shipping_element = document.getElementById("shippingPrice");
        var totalPriceMax_element = document.getElementById("total_price_tax");

        var totalPrice_input = document.getElementsByName("totalPriceExcl");
        var shipping_input = document.getElementsByName("shippingPrice");
        var taxTotalPrice_input = document.getElementsByName("totalPriceIncl");

        totalPrice_element.innerHTML =
            "Total price excl. tax: € " + totalPrice.toFixed(2);
        totalPrice_input.value = totalPrice.toFixed(2);
        console.log(totalPrice);
        var taxTotalPrice = totalPrice + 50;
        if (totalPrice >= 50) {
            taxTotalPrice = totalPrice;
            shipping_element.innerHTML = "Shipping Tax € 0.00";
            shipping_input.value = "0.00";
            totalPriceMax_element.innerHTML =
                "Total price incl. tax: € " + taxTotalPrice.toFixed(2);
            taxTotalPrice_input.value = totalPrice.toFixed(2);
            totalPrice_input.value = totalPrice.toFixed(2);
        } else if (totalPrice < 50) {
            shipping_element.innerHTML = "Shipping Tax € 50.00";
            shipping_input.value = "50.00";
            taxTotalPrice = totalPrice + 50;
            totalPriceMax_element.innerHTML =
                "Total price incl. tax: € " + taxTotalPrice.toFixed(2);
            taxTotalPrice_input.value = taxTotalPrice.toFixed(2);
        }
        console.log(totalPrice_input);
        console.log(shipping_input);
        console.log(taxTotalPrice_input);
    }
}

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

    infoPrice_element.innerHTML = "€ " + "<b>" + sum.toFixed(2);
    +"</b>";
    count_element.innerHTML = count;
    inputEl.value = count;

    calcTotalPrice();
}

function decrease(itemId, itemPrice) {
    var count_element = document.getElementById("itemAmount_" + itemId);
    var count = Number(count_element.innerHTML);
    count -= 1;
    if (count <= 1) {
        count = 1;
    }
    var infoPrice_element = document.getElementById("infoPrice_" + itemId);
    var sum = itemPrice * count;
    infoPrice_element.innerHTML = "€ " + "<b>" + sum.toFixed(2);
    +"</b>";
    count_element.innerHTML = count;

    calcTotalPrice();
}

flatpickr("#deliveryDate", {
    enableTime: false,
    dateFormat: "Y-m-d",
    minDate: "today",
    maxDate: new Date().fp_incr(22),
    inline: true,
    weekNumbers: true,
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
