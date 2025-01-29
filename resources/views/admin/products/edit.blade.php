@extends('layouts.admin')

@section('title', '商品編集ページ')

@section('content')

<div class="admin-products-edit-container">
    <form action="#" method="POST" enctype="multipart/form-data" class="admin-products-edit-form">
        @csrf
        <div class="admin-products-edit-info">
            <label class="admin-products-edit-label">商品名:
                <input type="text" class="admin-products-edit-input" placeholder="商品名">
            </label>
            <label class="admin-products-edit-label">価格:
                <input type="number" class="admin-products-edit-input" placeholder="価格">
            </label>
            <label class="admin-products-edit-label">在庫数:
                <input type="number" class="admin-products-edit-input" placeholder="在庫数">
            </label>
            <label class="admin-products-edit-label">商品説明:
                <textarea class="admin-products-edit-textarea" placeholder="商品説明"></textarea>
            </label>
        </div>
        <div class="admin-products-edit-image-section">
            <div class="admin-products-edit-image-header">
                <h3 class="admin-products-edit-image-title">画像管理</h3>
            </div>
            <div class="admin-products-edit-actions">
                <button class="admin-products-edit-add-image-button">追加</button>
                <span class="admin-products-edit-note">（画像はドラッグ＆ドロップで順序変更可能）</span>
            </div>
            <div class="admin-products-edit-image-container">
                <div class="admin-products-edit-image-box" data-id="1">
                    <img src="{{ asset('images/products/product1.jpg') }}" alt="商品画像1" class="admin-products-edit-image">
                    <button class="admin-products-edit-delete-image-button">削除</button>
                </div>
                <div class="admin-products-edit-image-box" data-id="2">
                    <img src="{{ asset('images/products/product2.jpg') }}" alt="商品画像2" class="admin-products-edit-image">
                    <button class="admin-products-edit-delete-image-button">削除</button>
                </div>
                <div class="admin-products-edit-image-box" data-id="3">
                    <img src="{{ asset('images/products/product3.jpg') }}" alt="商品画像3" class="admin-products-edit-image">
                    <button class="admin-products-edit-delete-image-button">削除</button>
                </div>
                <div class="admin-products-edit-image-box" data-id="4">
                    <img src="{{ asset('images/products/product4.jpg') }}" alt="商品画像4" class="admin-products-edit-image">
                    <button class="admin-products-edit-delete-image-button">削除</button>
                </div>
            </div>
        </div>
        <div class="admin-products-edit-buttons">
            <button type="submit">更新</button>
            <button type="button" onclick="history.back()">戻る</button>
        </div>
    </form>
</div>
<script src="{{ asset('js/Sortable.min.js') }}"></script>
<script src="{{ asset('js/admin-products-edit.js') }}"></script>


@endsection