@extends('layouts.admin')

@section('title', '注文管理')

@section('content')
@php
    $prefix = app()->environment('production') ? '/laravel' : '';
@endphp
<div class="order-management-page">
    <main>
        <section class="order-management-section">
            <h3 class="section-title">注文者情報</h3>
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
                    <input type="text" id="address" class="input-full" value="{{ $order->address ?? '住所未登録' }}" readonly>
                </div>
                <div class="form-group">
                    <label for="phone">電話番号:</label>
                    <input type="text" id="phone" class="input-full" value="{{ $order->phone ?? '000-0000-0000' }}" readonly>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label for="payment_method">支払い方法:</label>
                        <input type="text" id="payment_method" class="input-full"
                            value="{{ ['credit' => 'クレジットカード', 'bank' => '銀行振込', 'cash' => '代引き'][$order->payment_method] ?? '不明' }}" readonly>
                    </div>
                </div>
            </form>
        </section>
        <section class="order-items">
            <h3 class="section-title">注文商品</h3>
            @if($order->orderItems->isEmpty())
                <p>注文商品が見つかりません。</p>
            @else
                @foreach($order->orderItems as $item)
                <div class="order-item">
                    <div class="item-image">
                        <img src="{{ $item->product->first_image_url }}" alt="{{ $item->product->name }}">
                    </div>
                    <div class="item-info">
                        <div class="info-row">
                            <span>商品名</span>
                            <span>個数</span>
                            <span>価格</span>
                        </div>
                        <div class="info-row">
                            <span>
                                @foreach($order->orderItems as $item)
                                    {{ $item->product->name }}<br>
                                @endforeach
                            </span>
                            <span>
                                @foreach($order->orderItems as $item)
                                    {{ $item->quantity }}<br>
                                @endforeach
                            </span>
                            <span class="total-price">{{ number_format($order->total_price) }} 円</span>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </section>
        <section class="shipping-status">
            <h3 class="section-title">発送状況</h3>
            @if (session('success'))
            <script>
                alert("{!! session('success') !!}");
                location.reload();
            </script>
            @endif
            <form action="{{ $prefix }}{{ route('admin.orders.updateStatus', ['id' => $order->id]) }}" method="POST" class="status-update-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="status">発送状況:</label>
                    <select name="status" id="status" class="status-select">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>未発送</option>
                        <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>発送準備中</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>発送済み</option>
                    </select>
                    <button type="submit" class="status-update-button">更新</button>
                </div>
            </form>
        </section>
    </main>
</div>
@endsection
