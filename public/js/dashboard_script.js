document.addEventListener("DOMContentLoaded", function () {
    // Get the edit button
    var editButton = document.querySelector(".edit");

    // Get the edit form
    var editForm = document.querySelector(".dashboard_edit");

    // Add event listener to the edit button
    editButton.addEventListener("click", function () {
        // Toggle the visibility of the edit form
        editForm.style.display =
            editForm.style.display === "none" ? "block" : "none";
    });
});
