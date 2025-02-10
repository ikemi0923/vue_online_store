@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="product-detail-container">
    <div class="product-images">
        <div class="main-image">
            <img src="{{ $product->getFirstImageUrlAttribute() }}" alt="{{ $product->name }}">

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
    </div>
</div>

<script>
    function addToCart(productId) {
        let quantity = document.getElementById('product-quantity').value;

        fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                window.location.href = "{{ route('cart.index') }}";
            })
            .catch(error => console.error('カート追加エラー:', error));
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
</script>

@endsection