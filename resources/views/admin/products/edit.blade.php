@extends('layouts.admin')

@section('title', '商品編集')

@section('content')

<div class="admin-products-edit-container">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
        class="admin-products-edit-form">
        @csrf
        @method('PUT')
        <div class="admin-products-edit-info">
            <label class="admin-products-edit-label">商品名:
                <input type="text" name="name" class="admin-products-edit-input" placeholder="商品名" value="{{ old('name', $product->name) }}" required>
            </label>
            <label class="admin-products-edit-label">価格:
                <input type="number" name="price" class="admin-products-edit-input" placeholder="価格" value="{{ old('price', $product->price) }}" required>
            </label>
            <label class="admin-products-edit-label">在庫数:
                <input type="number" name="stock" class="admin-products-edit-input" placeholder="在庫数" value="{{ old('stock', $product->stock) }}" required>
            </label>
            <label class="admin-products-edit-label">商品説明:
                <textarea name="description" class="admin-products-edit-textarea" placeholder="商品説明">{{ old('description', $product->description) }}</textarea>
            </label>
        </div>
        <div class="admin-products-edit-image-section">
            <div class="admin-products-edit-image-header">
                <h3 class="admin-products-edit-image-title">画像管理</h3>
            </div>
            <div class="admin-products-edit-actions">
                <input type="file" name="images[]" id="images" multiple
                    accept="image/jpeg, image/png, image/jpg, image/gif, image/webp"
                    style="display: none;">
                <button type="button" class="admin-products-edit-add-image-button">画像を選択</button>
                <span class="admin-products-edit-note">（画像はドラッグ＆ドロップで順序変更可能）</span>
            </div>
            <div class="admin-products-edit-image-container" id="image-preview-container">
                @if($product->images->isNotEmpty())
                @foreach ($product->images->sortBy('order') as $image)
                <div class="admin-products-edit-image-box" data-image-id="{{ $image->id }}">
                    <img src="{{ asset('storage/' . $image->path) }}" alt="商品画像" class="admin-products-edit-image">
                    <button type="button" class="admin-products-edit-delete-image-button" data-image-id="{{ $image->id }}">削除</button>
                </div>
                @endforeach
                @endif
            </div>
        </div>
        <div class="admin-products-edit-buttons">
            <button type="submit" class="admin-products-edit-submit-button">更新</button>
            <button type="button" onclick="handleBack()" class="admin-products-edit-back-button">戻る</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/Sortable.min.js') }}"></script>
<script src="{{ asset('js/admin-products-edit.js') }}"></script>
<script>
    function handleBack() {
        if (window.history.length > 1) {
            history.back();
        } else {
            window.location.href = "{{ route('admin.products.index') }}";
        }
    }
</script>
@endsection