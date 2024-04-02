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
