@extends('layouts.app')

@section('title', '購入手続き')

@section('content')
<div class="order-checkout-container">
  <h2 class="order-checkout-title">注文者情報</h2>
  <form class="order-checkout-form" id="orderForm">
    @csrf
    <div class="order-checkout-section">
      <label for="name">お名前:</label>
      <input type="text" id="name" name="name" placeholder="姓名 (全角)" required>
      <label for="kana">フリガナ:</label>
      <input type="text" id="kana" name="kana" placeholder="セイメイ (全角カタカナ)" required>
      <label for="zip">郵便番号:</label>
      <div class="zip-inputs">
        <input type="text" id="zip1" name="zip1" maxlength="3" pattern="\d{3}" placeholder="000" required>
        <span>-</span>
        <input type="text" id="zip2" name="zip2" maxlength="4" pattern="\d{4}" placeholder="0000" required>
      </div>
      <label for="address">住所:</label>
      <input type="text" id="address-prefecture" name="address_prefecture" placeholder="都道府県" required>
      <input type="text" id="address-city" name="address_city" placeholder="市町村・番地" required>
      <input type="text" id="address-building" name="address_building" placeholder="マンション・ビル名 (任意)">
      <label for="phone">電話番号:</label>
      <div class="phone-inputs">
        <input type="text" id="phone1" name="phone1" maxlength="3" pattern="\d{3}" placeholder="090" required>
        <span>-</span>
        <input type="text" id="phone2" name="phone2" maxlength="4" pattern="\d{4}" placeholder="1234" required>
        <span>-</span>
        <input type="text" id="phone3" name="phone3" maxlength="4" pattern="\d{4}" placeholder="5678" required>
      </div>
    </div>
    <div class="payment-method-section">
      <label class="payment-label">
        <input type="radio" name="payment_option" value="credit" onclick="togglePaymentFields()" required>
        クレジットカード
      </label>
      <div id="credit-card-details" style="display: none;">
        <label for="cardholder-name">カード名義人 (ローマ字):</label>
        <input type="text" id="cardholder-name" name="cardholder_name" placeholder="例: TARO YAMADA">
        <label for="card-number">カード番号:</label>
        <input type="text" id="card-number" name="card_number" pattern="\d{16}" maxlength="16" placeholder="半角数字のみ (ハイフンなし)">
        <label for="expiration-date">有効期限:</label>
        <div class="expiration-date">
          <input type="text" id="expiration-month" name="expiration_month" pattern="\d{2}" maxlength="2" placeholder="月">
          <span>/</span>
          <input type="text" id="expiration-year" name="expiration_year" pattern="\d{2}" maxlength="2" placeholder="年">
        </div>
        <label for="security-code">セキュリティコード:</label>
        <input type="text" id="security-code" name="security_code" pattern="\d{3,4}" maxlength="4" placeholder="半角数字のみ">
      </div>
      <label class="payment-label">
        <input type="radio" name="payment_option" value="bank" onclick="togglePaymentFields()">
        銀行振込
      </label>
      <label class="payment-label">
        <input type="radio" name="payment_option" value="cash" onclick="togglePaymentFields()">
        代引き
      </label>
    </div>
    <button type="button" class="confirm-order-button" onclick="confirmOrder()">注文を確定する</button>
  </form>
</div>
<script defer src="{{ asset('js/order-checkout.js') }}"></script>
@endsection