@extends('layouts.admin')

@section('title', '注文管理ページ')

@section('content')
<div class="order-management-page">

    <main>
        <section class="order-management-section">
            <h3 class="section-title">注文者情報</h3>
            <form class="order-info-form">
                <div class="form-group">
                    <label for="name">お名前:</label>
                    <input type="text" id="name" class="input-full" placeholder="姓名（全角）">
                </div>
                <div class="form-group">
                    <label for="furigana">フリガナ:</label>
                    <input type="text" id="furigana" class="input-full" placeholder="姓名（全角カタカナ）">
                </div>
                <div class="form-group">
                    <label for="zip">郵便番号:</label>
                    <div class="inline-group">
                        <input type="text" id="zip1" class="input-small" placeholder="000">
                        <span>-</span>
                        <input type="text" id="zip2" class="input-small" placeholder="0000">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">住所:</label>
                    <div class="address-group">
                        <input type="text" id="prefecture" class="input-medium" placeholder="都道府県">
                        <input type="text" id="city" class="input-full" placeholder="市町村・番地">
                        <input type="text" id="building" class="input-full" placeholder="マンション・ビル名（任意）">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone">電話番号:</label>
                    <input type="text" id="phone" class="input-full" placeholder="09012345678">
                </div>
                <div class="form-group">
                    <label for="payment-method">お支払い方法:</label>
                    <select id="payment-method" class="input-medium">
                        <option value="credit_card">クレジットカード</option>
                        <option value="cash_on_delivery">代金引換</option>
                        <option value="bank_transfer">銀行振込</option>
                    </select>
                </div>
                <div id="form-container">
                    <div class="form-group">
                        <label for="card-number">カード番号:</label>
                        <input type="text" id="card-number" placeholder="半角数字のみ（ハイフンなし）" class="input-full">
                    </div>
                    <div class="form-group">
                        <label for="expiration-date">有効期限:</label>
                        <div class="date-group">
                            <input type="text" id="expiration-date-month" placeholder="月" class="input-small">
                            <input type="text" id="expiration-date-year" placeholder="年" class="input-small">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="card-holder">カード名義:</label>
                        <input type="text" id="card-holder" placeholder="例）TARO YAMADA" class="input-full">
                    </div>
                </div>
</div>


</form>
</section>

<section class="order-items">
    <h3 class="section-title">注文情報</h3>
    <div class="order-item">
        <div class="item-image">
            <img src="/images/products/product1.jpg" alt="商品画像1">
        </div>
        <div class="item-info">
            <div class="info-row">
                <span>商品名</span>
                <span>個数</span>
                <span>価格</span>
            </div>
            <div class="info-row">
                <span>商品名1</span>
                <span>1</span>
                <span>1000円</span>
            </div>
        </div>
    </div>
    <div class="order-item">
        <div class="item-image">
            <img src="/images/products/product2.jpg" alt="商品画像2">
        </div>
        <div class="item-info">
            <div class="info-row">
                <span>商品名</span>
                <span>個数</span>
                <span>価格</span>
            </div>
            <div class="info-row">
                <span>商品名2</span>
                <span>2</span>
                <span>2000円</span>
            </div>
        </div>
    </div>
</section>

<section class="shipping-status">
    <h3 class="section-title">発送状況</h3>
    <form action="#" method="POST" class="status-update-form">
        <div class="form-group">
            <label for="status">発送状況:</label>
            <select name="status" id="status" class="status-select">
                <option value="未発送" selected>未発送</option>
                <option value="発送準備中">発送準備中</option>
                <option value="発送済み">発送済み</option>
            </select>
            <button type="submit" class="status-update-button">更新</button>
        </div>
    </form>
</section>
</main>
</div>
@endsection