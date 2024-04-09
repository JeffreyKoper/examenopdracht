document.addEventListener("DOMContentLoaded", function () {
    // Get the edit button
    var editButton = document.querySelector(".edit");
    var createButton = document.querySelector(".create");

    // Get the edit form
    var editForm = document.querySelector(".dashboard_edit");
    var createForm = document.querySelector(".dashboard_create");

    // Add event listener to the edit button
    editButton.addEventListener("click", function () {
        // Toggle the visibility of the edit form
        editForm.style.display =
            editForm.style.display === "block" ? "none" : "block";
    });
    createButton.addEventListener("click", function () {
        // Toggle the visibility of the edit form
        createForm.style.display =
            createForm.style.display === "block" ? "none" : "block";
    });
});
var inboxTextElements = document.querySelectorAll(".inboxText");
inboxTextElements.forEach(function (element) {
    var originalText = element.textContent;
    var shortenedText = shortenText(originalText, 40); // Shorten to 30 characters
    element.textContent = shortenedText;
});
function shortenText(text, maxLength) {
    if (text.length > maxLength) {
        return text.substring(0, maxLength).trim() + "...";
    } else {
        return text;
    }
}
