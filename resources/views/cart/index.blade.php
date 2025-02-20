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
                <img src="{{ $item['image'] }}" alt="商品画像" class="cart-item-image">
            </div>
            <p class="cart-item-name">{{ $item['name'] }}</p>
            <div class="cart-item-quantity">
                <button class="cart-item-quantity-button" onclick="updateCart({{ $id }}, {{ $item['quantity'] - 1 }})">−</button>
                <input type="number" value="{{ $item['quantity'] }}" class="cart-item-input" readonly>
                <button class="cart-item-quantity-button" onclick="updateCart({{ $id }}, {{ $item['quantity'] + 1 }})">＋</button>
            </div>
            <p class="cart-item-price">{{ number_format($item['price']) }}円</p>
            <button class="cart-item-delete" onclick="confirmDelete({{ $id }})">削除</button>

            <form id="delete-form-{{ $id }}" action="{{ route('cart.remove', $id) }}" method="POST" style="display: none;">
                @csrf
            </form>
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
        <div class="cart-buttons">
            <button class="cart-back-button"
                onclick="location.href='{{ route('products.show', ['id' => collect($cart)->first()['id'] ?? 1]) }}'">
                戻る
            </button>
            <button class="cart-checkout-button"
                onclick="proceedToCheckout()">
                次へ進む
            </button>
        </div>
    </section>
</main>
<script>
    function proceedToCheckout() {
        let cart = JSON.parse(sessionStorage.getItem("cart")) || [];
        if (cart.length === 0) {
            alert("カートが空です。");
            window.location.href = "{{ route('home') }}";
        } else {
            sessionStorage.setItem("cart", JSON.stringify(cart));
            window.location.href = "{{ route('order.checkout') }}";
        }
    }
</script>
<script>
    function confirmDelete(productId) {
        if (!confirm("本当に削除しますか？")) return;
        fetch("{{ route('cart.remove') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute("content")
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert("エラー: " + data.error);
                } else {
                    alert("✅ 商品を削除しました");
                    location.reload();
                }
            })
            .catch(error => {
                alert("削除できませんでした。");
            });
    }
</script>
<script>
    function updateCart(productId, newQuantity) {
        if (newQuantity < 1) {
            alert("⚠️ 数量は 1 以上でなければなりません。");
            return;
        }
        fetch("{{ route('cart.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector("meta[name='csrf-token']").getAttribute("content")
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert("エラー: " + data.error);
                } else {
                    alert("✅ 数量を更新しました");
                    location.reload();
                }
            })
            .catch(error => {
                alert("数量を変更できませんでした。");
            });
    }
</script>
@endsection