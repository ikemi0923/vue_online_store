@extends('layouts.admin')

@section('title', '商品管理ページ')

@section('content')

<div class="order-management-container">
    <div class="admin-products-list">
        <div class="admin-product-item">
            <div class="product-image">
                <img src="{{ asset('images/products/product1.jpg') }}" alt="商品画像1">
            </div>
            <div class="product-details">
                <p><strong>商品名:</strong> 商品名1</p>
                <p><strong>価格:</strong> 1000円</p>
                <p><strong>在庫数:</strong> 10</p>
                <p><strong>商品説明:</strong> 商品1の説明がここに入ります。</p>
            </div>
            <div class="product-actions">
                <button class="admin-products-edit-button">編集</button>
                <button class="admin-products-delete-button">削除</button>
            </div>
        </div>
        <div class="admin-product-item">
            <div class="product-image">
                <img src="{{ asset('images/products/product2.jpg') }}" alt="商品画像2">
            </div>
            <div class="product-details">
                <p><strong>商品名:</strong> 商品名2</p>
                <p><strong>価格:</strong> 2000円</p>
                <p><strong>在庫数:</strong> 5</p>
                <p><strong>商品説明:</strong> 商品2の説明がここに入ります。</p>
            </div>
            <div class="product-actions">
                <button class="admin-products-edit-button">編集</button>
                <button class="admin-products-delete-button">削除</button>
            </div>
        </div>
        <div class="admin-product-item">
            <div class="product-image">
                <img src="{{ asset('images/products/product3.jpg') }}" alt="商品画像3">
            </div>
            <div class="product-details">
                <p><strong>商品名:</strong> 商品名3</p>
                <p><strong>価格:</strong> 3000円</p>
                <p><strong>在庫数:</strong> 8</p>
                <p><strong>商品説明:</strong> 商品3の説明がここに入ります。</p>
            </div>
            <div class="product-actions">
                <button class="admin-products-edit-button">編集</button>
                <button class="admin-products-delete-button">削除</button>

            </div>
        </div>
    </div>
</div>
@endsection