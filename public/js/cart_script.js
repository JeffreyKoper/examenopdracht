flatpickr("#deliveryDate", {
    enableTime: false,
    dateFormat: "Y-m-d",
    minDate: "today",
    maxDate: new Date().fp_incr(22),
    inline: true,
    weekNumbers: true,
});
