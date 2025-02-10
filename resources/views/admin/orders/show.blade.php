@extends('layouts.admin')

@section('title', '注文詳細ページ')

@section('content')
<div class="order-management-page">
    <main>
        <section class="order-management-section">
            <h3 class="section-title">注文者情報</h3>
            @if(!empty($order))
            <form class="order-info-form">
                <div class="form-group">
                    <label for="name">お名前:</label>
                    <input type="text" id="name" class="input-full" value="{{ $order->name ?? '不明' }}" readonly>
                </div>

                <div class="form-group">
                    <label for="furigana">フリガナ:</label>
                    <input type="text" id="furigana" class="input-full" value="{{ $order->furigana ?? '不明' }}" readonly>
                </div>

                <div class="form-group">
                    <label for="zip">郵便番号:</label>
                    <input type="text" id="zip" class="input-full" value="{{ $order->zip ?? '000-0000' }}" readonly>
                </div>

                <div class="form-group">
                    <label for="address">住所:</label>
                    <input type="text" id="address" class="input-full"
                        value="{{ $order->address ?? '住所未登録' }}" readonly>

                </div>

                <div class="form-group">
                    <label for="phone">電話番号:</label>
                    <input type="text" id="phone" class="input-full" value="{{ $order->phone ?? '000-0000-0000' }}" readonly>
                </div>

                <div class="form-group">
                    <label for="payment_method">支払い方法:</label>
                    <input type="text" id="payment_method" class="input-full" value="{{ $order->payment_method_label }}" readonly>
                </div>

            </form>
            @else
            <p>注文情報が見つかりません。</p>
            @endif
        </section>

        <section class="order-items">
            <h3 class="section-title">注文情報</h3>
            @if(!empty($order->orderItems) && count($order->orderItems) > 0)
            @foreach($order->orderItems as $item)
            <div class="order-item">
                <div class="item-image">
                    @if(!empty($item->product) && !empty($item->product->image) && !empty($item->product->image->path))
                    <img src="{{ asset('storage/' . $item->product->image->path) }}" alt="商品画像">
                    @else
                    <img src="{{ asset('images/no-image.png') }}" alt="商品画像">
                    @endif
                </div>
                <div class="item-info">
                    <div class="info-row">
                        <span>商品名</span>
                        <span>個数</span>
                        <span>価格</span>
                    </div>
                    <div class="info-row">
                        <span>{{ $item->product->name ?? '不明' }}</span>
                        <span>{{ $item->quantity ?? 0 }}</span>
                        <span>{{ isset($item->product->price, $item->quantity) ? number_format($item->product->price * $item->quantity) : '0' }}円</span>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p>注文商品が見つかりません。</p>
            @endif
        </section>

        <section class="shipping-status">
            <h3 class="section-title">発送状況</h3>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(!empty($order))
            <form action="{{ route('admin.orders.updateStatus', ['id' => $order->id]) }}" method="POST" class="status-update-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">発送状況:</label>
                    <select name="status" id="status" class="status-select">
                        <option value="未発送" {{ $order->status == '未発送' ? 'selected' : '' }}>未発送</option>
                        <option value="発送準備中" {{ $order->status == '発送準備中' ? 'selected' : '' }}>発送準備中</option>
                        <option value="発送済み" {{ $order->status == '発送済み' ? 'selected' : '' }}>発送済み</option>
                    </select>
                    <button type="submit" class="status-update-button">更新</button>
                </div>
            </form>
            @endif
        </section>
    </main>
</div>
@endsection