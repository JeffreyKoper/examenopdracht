// Ensure DOM content is loaded before executing script
document.addEventListener("DOMContentLoaded", function () {
    // Get the edit and create buttons
    var editButton = document.querySelector(".edit");
    var createButton = document.querySelector(".create");

    // Get the edit and create forms
    var editForm = document.querySelector(".dashboard_edit");
    var createForm = document.querySelector(".dashboard_create");

    // Add event listener to the edit button
    editButton.addEventListener("click", function () {
        // Toggle the visibility of the edit form
        editForm.style.display =
            editForm.style.display === "block" ? "none" : "block";
    });

    // Add event listener to the create button
    createButton.addEventListener("click", function () {
        // Toggle the visibility of the create form
        createForm.style.display =
            createForm.style.display === "block" ? "none" : "block";
    });
});

// Retrieve all elements with the class "inboxText"
var inboxTextElements = document.querySelectorAll(".inboxText");

// Iterate through each element and shorten the text if necessary
inboxTextElements.forEach(function (element) {
    var originalText = element.textContent;
    var shortenedText = shortenText(originalText, 40); // Shorten to 40 characters
    element.textContent = shortenedText;
});

// Function to shorten text to a specified maximum length
function shortenText(text, maxLength) {
    if (text.length > maxLength) {
        // If text exceeds the maximum length, truncate and add ellipsis
        return text.substring(0, maxLength).trim() + "...";
    } else {
        // Otherwise, return the original text
        return text;
    }
}
