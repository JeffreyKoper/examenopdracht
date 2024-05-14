// Execute script when the DOM is ready
document.addEventListener("DOMContentLoaded", function () {
    // Get all star elements
    const stars = document.querySelectorAll(".stars li");

    // Get the rating input element
    const ratingInput = document.querySelector("input[name='rating']");

    // Add click event listener to each star
    stars.forEach((star) => {
        star.addEventListener("click", function () {
            // Get the value of the clicked star
            const value = parseInt(star.getAttribute("value"));

            // Remove 'selected' class from all stars
            stars.forEach((s) => s.classList.remove("selected"));

            // Add 'selected' class to the clicked star and update rating input value
            star.classList.add("selected");
            ratingInput.value = value;
        });
    });
});
