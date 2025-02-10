@extends('layouts.admin')

@section('title', '商品管理ページ')

@section('content')

<<<<<<< HEAD
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
=======
@if (session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        alert("{{ session('success') }}");
        window.location.href = "{{ route('admin.products.index') }}";
    });
</script>
@endif
>>>>>>> aa17340 (バックエンドの更新)

<div class="product-management-container">
    <div class="products-header-container">
        <h2 class="products-index-title">商品一覧</h2>
        <a href="{{ route('admin.products.add') }}" class="admin-products-add-button">商品追加</a>
    </div>

    <div class="admin-products-list">
        @if (isset($products) && $products->isEmpty())
        <p>商品がありません。</p>
        @else
        @foreach ($products as $product)
        <div class="admin-product-item">
            <div class="product-image">
                @if ($product->images->isNotEmpty())
                <img src="{{ asset('storage/' . $product->images->first()->path) }}" alt="商品画像">
                @else
                <img src="{{ asset('images/no-image.png') }}" alt="画像なし">
                @endif
            </div>
            <div class="product-details">
                <p><strong>商品名:</strong> {{ $product->name }}</p>
                <p><strong>価格:</strong> {{ number_format($product->price) }}円</p>
                <p><strong>在庫数:</strong> {{ $product->stock }}</p>
                <p><strong>商品説明:</strong> {{ $product->description }}</p>
            </div>
            <div class="product-actions">
                <form action="{{ route('admin.products.edit', $product->id) }}" method="GET" style="display:inline;">
                    <button type="submit" class="admin-products-edit-button">編集</button>
                </form>

                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="admin-products-delete-button" onclick="return confirm('本当に削除しますか？');">削除</button>
                </form>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection