// Execute script when DOM content is loaded
document.addEventListener("DOMContentLoaded", function () {
    // Retrieve all elements with the class "clickable"
    const clickableDivs = document.querySelectorAll(".clickable");

    // Add click event listener to each clickable div
    clickableDivs.forEach(function (div) {
        div.addEventListener("click", function () {
            // Get the route from the data attribute
            const route = this.getAttribute("data-route");

            // Redirect to the specified route
            window.location.href = route;
        });
    });
});
