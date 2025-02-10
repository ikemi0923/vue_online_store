document.addEventListener("DOMContentLoaded", function () {
    const orderButton = document.querySelector(".confirm-order-button");
    const paymentOptions = document.querySelectorAll("input[name='payment_option']");
    const creditCardDetails = document.getElementById("credit-card-details");

    window.togglePaymentFields = function () {
        const selectedPayment = document.querySelector("input[name='payment_option']:checked") ?.value;
        if (selectedPayment === "credit") {
            creditCardDetails.style.display = "block";
        } else {
            creditCardDetails.style.display = "none";
        }
    };

    paymentOptions.forEach(option => {
        option.addEventListener("change", togglePaymentFields);
    });

    togglePaymentFields();

    window.confirmOrder = function () {
        let formValid = true;
        const requiredFields = document.querySelectorAll("input[required]");

        requiredFields.forEach(field => {
            field.classList.remove("checkout-error-input");
        });

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                formValid = false;
                field.classList.add("checkout-error-input");
            }
        });

        if (!formValid) {
            alert("入力に誤りがあります。修正してください。");
            return;
        }
        const csrfToken = document.querySelector("meta[name='csrf-token']") ?.getAttribute("content");
        if (!csrfToken) {
            alert("⚠️ CSRFトークンが見つかりません。リロードして再試行してください。");
            return;
        }

        fetch("/order/confirm", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({
                    name: document.getElementById("name").value,
                    kana: document.getElementById("kana").value,
                    zip1: document.getElementById("zip1").value,
                    zip2: document.getElementById("zip2").value,
                    address_prefecture: document.getElementById("address-prefecture").value,
                    address_city: document.getElementById("address-city").value,
                    phone1: document.getElementById("phone1").value,
                    phone2: document.getElementById("phone2").value,
                    phone3: document.getElementById("phone3").value,
                    payment_option: document.querySelector("input[name='payment_option']:checked") ?.value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "/order/complete";
                } else {
                    alert("バリデーションエラー: " + JSON.stringify(data.errors));
                }
            })
            .catch(error => {
                alert("注文処理に失敗しました。再度お試しください。");
            });
    };
});
