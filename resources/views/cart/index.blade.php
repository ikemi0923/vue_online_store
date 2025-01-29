@extends('layouts.app')

@section('title', 'ショッピングカート')

@section('content')

<main class="cart-container">
    <h2 class="cart-title">ショッピングカート</h2>
    <section class="cart-items">
        <div class="cart-item">
            <div class="cart-item-image-container">
                <img src="{{ asset('images/products/product1.jpg') }}" alt="商品画像" class="cart-item-image">
            </div>
            <p class="cart-item-name">商品A</p>
            <div class="cart-item-quantity">
                <button class="cart-item-quantity-button">−</button>
                <input type="number" value="1" class="cart-item-input" readonly>
                <button class="cart-item-quantity-button">＋</button>
            </div>
            <p class="cart-item-price">1000円</p>
            <button class="cart-item-delete">削除</button>
        </div>
        <div class="cart-item">
            <div class="cart-item-image-container">
                <img src="{{ asset('images/products/product1.jpg') }}" alt="商品画像" class="cart-item-image">
            </div>
            <p class="cart-item-name">商品B</p>
            <div class="cart-item-quantity">
                <button class="cart-item-quantity-button">−</button>
                <input type="number" value="2" class="cart-item-input" readonly>
                <button class="cart-item-quantity-button">＋</button>
            </div>
            <p class="cart-item-price">2000円</p>
            <button class="cart-item-delete">削除</button>
        </div>
        <div class="cart-item">
            <div class="cart-item-image-container">
                <img src="{{ asset('images/products/product1.jpg') }}" alt="商品画像" class="cart-item-image">
            </div>
            <p class="cart-item-name">商品C</p>
            <div class="cart-item-quantity">
                <button class="cart-item-quantity-button">−</button>
                <input type="number" value="1" class="cart-item-input" readonly>
                <button class="cart-item-quantity-button">＋</button>
            </div>
            <p class="cart-item-price">3000円</p>
            <button class="cart-item-delete">削除</button>
        </div>
    </section>

    <section class="cart-summary">
        <div class="cart-summary-details">
            <p class="cart-summary-item">小計: <span>6000円</span></p>
            <p class="cart-summary-item">送料: <span>500円</span></p>
            <p class="cart-summary-item">消費税: <span>500円</span></p>
            <p class="cart-summary-total">合計: <span>7000円</span></p>
        </div>
        <button class="cart-checkout-button">次へ進む</button>
    </section>
</main>
@endsection
