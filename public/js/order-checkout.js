
window.togglePaymentFields = function () {
    const selectedPayment = document.querySelector("input[name='payment_option']:checked") ?.value;
    const creditCardDetails = document.getElementById("credit-card-details");
    if (creditCardDetails) {
        creditCardDetails.style.display = selectedPayment === "credit" ? "block" : "none";
    }
};

function syncCartData() {
    fetch("/cart/data", {
            method: "GET",
            credentials: "include"
        })
        .then(response => response.json())
        .then(cartData => {
            if (cartData.cart && Object.keys(cartData.cart).length > 0) {
                localStorage.setItem("cart", JSON.stringify(cartData.cart));
            } else {
                localStorage.removeItem("cart");
            }
        });
}

window.confirmOrder = function () {
    
    let nameElement = document.getElementById("name");
    let kanaElement = document.getElementById("kana");
    let zip1Element = document.getElementById("zip1");
    let zip2Element = document.getElementById("zip2");
    let addressPrefectureElement = document.getElementById("address-prefecture");
    let addressCityElement = document.getElementById("address-city");
    let phone1Element = document.getElementById("phone1");
    let phone2Element = document.getElementById("phone2");
    let phone3Element = document.getElementById("phone3");

    if (!nameElement || !zip1Element || !phone1Element) {
        alert("⚠️ フォームの入力欄が正しくありません。ページをリロードして再試行してください。");
        return;
    }

    let name = nameElement.value;
    let kana = kanaElement ? kanaElement.value : "";
    let zip1 = zip1Element.value;
    let zip2 = zip2Element.value;
    let addressPrefecture = addressPrefectureElement ? addressPrefectureElement.value : "";
    let addressCity = addressCityElement ? addressCityElement.value : "";
    let phone1 = phone1Element.value;
    let phone2 = phone2Element.value;
    let phone3 = phone3Element.value;

    let paymentOptionElement = document.querySelector("input[name='payment_option']:checked");
    let paymentOption = paymentOptionElement ? paymentOptionElement.value : null;

    if (!paymentOption) {
        alert("⚠️ 支払い方法を選択してください");
        return;
    }

    let orderData = {
        name: name,
        kana: kana,
        zip1: zip1,
        zip2: zip2,
        address_prefecture: addressPrefecture,
        address_city: addressCity,
        phone1: phone1,
        phone2: phone2,
        phone3: phone3,
        payment_option: paymentOption,
        cart: JSON.parse(localStorage.getItem("cart"))
    };

    fetch("http://t014.codelab-vuetech2.net/laravel/order/confirm", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
            },
            body: JSON.stringify(orderData)
        })
        .then(response => response.text())
        .then(data => {
            try {
                let jsonData = JSON.parse(data);
                if (jsonData.success) {
                    alert("✅ 注文が完了しました！");
                    localStorage.removeItem("cart");
                    window.location.href = "/laravel/order/complete";
                } else {
                    alert("❌ 入力項目に誤りがあります ");
                }
            } catch (error) {
                alert("⚠️ サーバーから不正なレスポンスが返されました。");
            }
        })
        .catch(error => {
            alert("⚠️ サーバーとの通信に問題があります。");
        });
};

document.addEventListener("DOMContentLoaded", function () {
    syncCartData();
});
