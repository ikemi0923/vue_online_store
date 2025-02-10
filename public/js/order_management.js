document.addEventListener("DOMContentLoaded", function () {
    const paymentMethod = document.getElementById("payment-method");
    const creditCardFields = document.getElementById("credit-card-fields");

    if (paymentMethod.value === "credit_card") {
        creditCardFields.style.display = "grid";
    } else {
        creditCardFields.style.display = "none";
    }

    paymentMethod.addEventListener("change", function () {
        if (paymentMethod.value === "credit_card") {
            creditCardFields.style.display = "grid";
        } else {
            creditCardFields.style.display = "none";
        }
    });
});
