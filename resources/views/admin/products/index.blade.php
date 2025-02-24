@extends('layouts.admin')

@section('title', '商品管理')

@section('content')

@if (session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        alert("{{ session('success') }}");
        window.location.href = "{{ route('admin.products.index') }}";
    });
</script>
@endif
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
                <img src="{{ $product->first_image_url }}" alt="{{ $product->name }}">
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
    <div class="admin-pagination-container">
        {{ $products->links('vendor.pagination.admin') }}
    </div>
</div>
@endsection