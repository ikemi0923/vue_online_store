@extends('layouts.admin')

@section('title', '商品追加ページ')

@section('content')
<div class="admin-products-add-container">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="admin-products-add-form">

        @csrf
        <div class="admin-products-add-info">
            <label class="admin-products-add-label">商品名:
                <input type="text" name="name" class="admin-products-add-input" placeholder="商品名" value="{{ old('name') }}" required>
                @error('name')
                <span class="error">{{ $message }}</span>
                @enderror
            </label>

            <label class="admin-products-add-label">価格:
                <input type="number" name="price" class="admin-products-add-input" placeholder="価格" value="{{ old('price') }}" required>
                @error('price')
                <span class="error">{{ $message }}</span>
                @enderror
            </label>

            <label class="admin-products-add-label">在庫数:
                <input type="number" name="stock" class="admin-products-add-input" placeholder="在庫数" value="{{ old('stock') }}" required>
                @error('stock')
                <span class="error">{{ $message }}</span>
                @enderror
            </label>

            <label class="admin-products-add-label">商品説明:
                <textarea name="description" class="admin-products-add-textarea" placeholder="商品説明">{{ old('description') }}</textarea>
                @error('description')
                <span class="error">{{ $message }}</span>
                @enderror
            </label>
        </div>

        <div class="admin-products-add-image-section">
            <div class="admin-products-edit-image-header">
                <h3 class="admin-products-add-image-title">画像管理</h3>
            </div>

            <div class="admin-products-add-actions">
                <label for="images" class="admin-products-add-add-image-button">画像を選択</label>
                <span class="admin-products-add-note">（画像はドラッグ＆ドロップで順序変更可能）</span>
            </div>
<<<<<<< HEAD
            <div class="admin-products-add-image-container">
                <div class="admin-products-add-image-box" data-id="1">
                    <img src="{{ asset('images/products/product1.jpg') }}" alt="商品画像1" class="admin-products-add-image">
                    <button class="admin-products-add-delete-image-button">削除</button>
                </div>
                <div class="admin-products-add-image-box" data-id="2">
                    <img src="{{ asset('images/products/product2.jpg') }}" alt="商品画像2" class="admin-products-add-image">
                    <button class="admin-products-add-delete-image-button">削除</button>
                </div>
                <div class="admin-products-add-image-box" data-id="3">
                    <img src="{{ asset('images/products/product3.jpg') }}" alt="商品画像3" class="admin-products-add-image">
                    <button class="admin-products-add-delete-image-button">削除</button>
                </div>
                <div class="admin-products-add-image-box" data-id="4">
                    <img src="{{ asset('images/products/product4.jpg') }}" alt="商品画像4" class="admin-products-add-image">
                    <button class="admin-products-add-delete-image-button">削除</button>
                </div>
=======

            <div class="admin-products-add-image-container" id="image-preview-container">
                @if(isset($product) && $product->images->isNotEmpty())
                @foreach ($product->images->sortBy('order') as $image)
                <img src="{{ asset('storage/' . $image->path) }}" alt="商品画像">
                @endforeach
                @endif

            </div>

            <div class="admin-products-add-buttons">
                <button type="submit" class="admin-products-add-submit-button">追加</button>
                <form action="{{ route('admin.dashboard') }}" method="GET" style="display:inline;">
                    <button type="submit" class="admin-products-add-back-button">戻る</button>
                </form>

>>>>>>> aa17340 (バックエンドの更新)
            </div>
    </form>
</div>

<script src="{{ asset('js/Sortable.min.js') }}"></script>
<script src="{{ asset('js/admin-products-add.js') }}"></script>
@endsection