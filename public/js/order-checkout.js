document.addEventListener('DOMContentLoaded', function () {
    const paymentOptions = document.querySelectorAll('input[name="payment_option"]');
    const creditCardDetails = document.getElementById('credit-card-details');

    paymentOptions.forEach(option => {
        option.addEventListener('change', function () {
            if (this.value === 'credit') {
                creditCardDetails.style.display = 'block';
            } else {
                creditCardDetails.style.display = 'none';
            }
        });
    });
});
