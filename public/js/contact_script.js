var inboxTextElements = document.querySelectorAll(".messageDescription");
inboxTextElements.forEach(function (element) {
    var originalText = element.textContent;
    var shortenedText = shortenText(originalText, 50); // Shorten to 30 characters
    element.textContent = shortenedText;
});
function shortenText(text, maxLength) {
    if (text.length > maxLength) {
        return text.substring(0, maxLength).trim() + "...";
    } else {
        return text;
    }
}
