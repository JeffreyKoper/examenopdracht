// JavaScript for carousel animation
let currentSlide = 0;
const slideWidth = document.querySelector(".slide").clientWidth;
const carousel = document.querySelector(".carousel");
const promoMessages = [
    "Welcome to Wardrobe Wonders",
    "Use Promo Code: 'SPRINGSALE20' for 20% off your next order! ",
    "Discover Your Style",
    "Limited Time Offer: 30% Off!",
    "Elevate Your Wardrobe",
    "Join Our Fashion Community",
    "New Arrivals Just In!",
    "Upgrade Your Basics",
];
const promoMessageElement = document.getElementById("promo-message");

function nextSlide() {
    currentSlide = (currentSlide + 1) % promoMessages.length; // Adjust 3 to the total number of slides
    carousel.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
    promoMessageElement.textContent = promoMessages[currentSlide];
}

setInterval(nextSlide, 7000); // Change slide every 7 seconds

// Optional: Replace the placeholder promo code with an actual promo code
document.getElementById("promo-message").textContent =
    promoMessages[currentSlide];
