// Retrieve all elements with the class "messageDescription"
var inboxTextElements = document.querySelectorAll(".messageDescription");

// Iterate through each element and shorten the text if necessary
inboxTextElements.forEach(function (element) {
    var originalText = element.textContent;
    var shortenedText = shortenText(originalText, 50); // Shorten to 50 characters
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
