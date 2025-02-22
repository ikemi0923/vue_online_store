@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
@php
    $prefix = app()->environment('production') ? '/laravel' : '';
@endphp
<div class="product-detail-container">
    <div class="product-images">
        <div class="main-image">
            <img id="main-product-image" src="{{ $prefix }}{{ $product->getFirstImageUrlAttribute() }}" alt="{{ $product->name }}">
        </div>
        <div class="thumbnail-images">
            @foreach ($product->images->sortBy('id') as $image)
                <img src="{{ $prefix }}{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}" class="thumbnail" onclick="changeMainImage(this)">
            @endforeach
        </div>
    </div>
    <div class="product-info">
        <h2>商品名: {{ $product->name }}</h2>
        <p>価格: {{ number_format($product->price) }}円</p>
        <div class="quantity-control">
            <button type="button" class="quantity-btn" onclick="changeQuantity(-1)">−</button>
            <input type="number" id="product-quantity" value="1" min="1" readonly>
            <button type="button" class="quantity-btn" onclick="changeQuantity(1)">＋</button>
        </div>
        <button class="add-to-cart" onclick="addToCart({{ $product->id }})">カートに入れる</button>
        <div class="product-description">
            <p>{{ $product->description }}</p>
        </div>
        <div class="product-detail-back">
            <button class="product-detail-back-button" onclick="addToCart({{ $product->id }})">戻る</button>
        </div>
    </div>
</div>
<script>
    function addToCart(productId) {
        fetch("{{ url('/cart/add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute("content")
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: document.getElementById('product-quantity').value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert("エラー: " + data.error);
                } else {
                    alert("✅ 商品がカートに追加されました");
                    window.location.href = "/cart";
                }
            })
            .catch(error => {
                alert("カートに追加できませんでした。");
            });
    }
    function changeQuantity(change) {
        let quantityInput = document.getElementById('product-quantity');
        let currentQuantity = parseInt(quantityInput.value);
        let newQuantity = currentQuantity + change;
        if (newQuantity < 1) {
            newQuantity = 1;
        }
        quantityInput.value = newQuantity;
    }
    function changeMainImage(element) {
        document.getElementById("main-product-image").src = element.src;
    }
</script>
@endsection
