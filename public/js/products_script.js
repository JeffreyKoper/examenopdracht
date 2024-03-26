document.addEventListener("DOMContentLoaded", function () {
    const clickableDivs = document.querySelectorAll(".clickable");

    clickableDivs.forEach(function (div) {
        div.addEventListener("click", function () {
            const route = this.getAttribute("data-route");
            window.location.href = route;
        });
    });
});
