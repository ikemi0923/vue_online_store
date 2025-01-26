@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="product-detail-container">
    <div class="product-images">
        <div class="main-image">
            <img src="{{ asset('images/products/product1.jpg') }}" alt="メイン商品画像">
        </div>
        <div class="sub-images">
            <div class="sub-image">
                <img src="{{ asset('images/products/product2.jpg') }}" alt="商品画像1">
            </div>
            <div class="sub-image">
                <img src="{{ asset('images/products/product3.jpg') }}" alt="商品画像2">
            </div>
            <div class="sub-image">
                <img src="{{ asset('images/products/product4.jpg') }}" alt="商品画像3">
            </div>
            <div class="sub-image">
                <img src="{{ asset('images/products/product5.jpg') }}" alt="商品画像4">
            </div>
            <div class="sub-image">
                <img src="{{ asset('images/products/product6.jpg') }}" alt="商品画像5">
            </div>
            <div class="sub-image">
                <img src="{{ asset('images/products/product6.jpg') }}" alt="商品画像6">
            </div>
        </div>
    </div>
    <div class="product-info">
        <h2>商品名: サンプル商品A</h2>
        <p>価格: 1000円</p>
        <div class="quantity-control">
            <button type="button" class="quantity-btn">−</button>
            <input type="number" value="1" min="1" readonly>
            <button type="button" class="quantity-btn">＋</button>
        </div>
        <button class="add-to-cart">カートに入れる</button>
        <div class="product-description">
            <p>木材の素材感を活かした美しい漆塗りの椀...</p>
        </div>
    </div>
    @endsection