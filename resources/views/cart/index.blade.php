@extends('layouts.app')

@section('title', 'ショッピングカート')

@section('content')
@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif

<main class="cart-container">
    <h2 class="cart-title">ショッピングカート</h2>

    <section class="cart-items">
        @forelse($cart as $id => $item)
        <div class="cart-item">
            <div class="cart-item-image-container">
<<<<<<< HEAD
                <img src="{{ asset('images/products/product1.jpg') }}" alt="商品画像" class="cart-item-image">
=======
                <img src="{{ asset($item['image']) }}" alt="商品画像" class="cart-item-image">
>>>>>>> aa17340 (バックエンドの更新)
            </div>
            <p class="cart-item-name">{{ $item['name'] }}</p>
            <div class="cart-item-quantity">
            @php
    $decreaseQuantity = $item['quantity'] - 1;
    $increaseQuantity = $item['quantity'] + 1;
@endphp

<button class="cart-item-quantity-button" onclick="updateCart({{ $id }}, {{ $decreaseQuantity }})">−</button>
<input type="number" value="{{ $item['quantity'] }}" class="cart-item-input" readonly>
<button class="cart-item-quantity-button" onclick="updateCart({{ $id }}, {{ $increaseQuantity }})">＋</button>

            </div>
<<<<<<< HEAD
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
=======
            <p class="cart-item-price">{{ number_format($item['price']) }}円</p>
            <form action="{{ route('cart.remove', ['id' => $id]) }}" method="POST">
                @csrf
                <button type="submit" class="cart-item-delete">削除</button>
            </form>

            <form id="delete-form-{{ $id }}" action="{{ route('cart.remove', ['id' => $id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

>>>>>>> aa17340 (バックエンドの更新)
        </div>
        @empty
        <p>カートに商品はありません。</p>
        @endforelse
    </section>

    <section class="cart-summary">
        <div class="cart-summary-details">
            <p class="cart-summary-item">小計: <span>{{ number_format($subtotal) }}円</span></p>
            <p class="cart-summary-item">送料: <span>{{ number_format($shipping) }}円</span></p>
            <p class="cart-summary-item">消費税: <span>{{ number_format($tax) }}円</span></p>
            <p class="cart-summary-total">合計: <span>{{ number_format($total) }}円</span></p>
        </div>
        <button class="cart-checkout-button" onclick="proceedToCheckout()">次へ進む</button>

        <script>
            function proceedToCheckout() {
                window.location.href = "{{ route('order.checkout') }}";
            }
        </script>

    </section>
</main>

<script>
    function updateCart(id, quantity) {
        fetch('{{ route("cart.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id,
                quantity
            })
        }).then(() => location.reload());
    }

    function confirmDelete(cartItemId) {
        if (confirm("本当に削除しますか？")) {
            document.getElementById('delete-form-' + cartItemId).submit();
        }
    }
</script>

@endsection