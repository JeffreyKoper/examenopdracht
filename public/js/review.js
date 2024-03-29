document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".stars li");
    const ratingInput = document.querySelector("input[name='rating']");

    stars.forEach((star) => {
        star.addEventListener("click", function () {
            const value = parseInt(star.getAttribute("value"));
            stars.forEach((s) => s.classList.remove("selected"));
            star.classList.add("selected");
            ratingInput.value = value;
        });
    });
});
