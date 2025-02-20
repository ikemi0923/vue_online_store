@extends('layouts.admin')

@section('title', '管理者トップページ')

@section('content')
@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif

<main class="admin-dashboard-main">
    <div class="admin-dashboard-container">
        <div class="admin-dashboard-buttons">
            <a href="{{ route('admin.products.index') }}" class="admin-dashboard-button">商品管理</a>
            <a href="{{ route('admin.orders.index') }}" class="admin-dashboard-button">注文管理</a>
        </div>
        <div class="admin-dashboard-search">
            <form action="{{ route('admin.orders.index') }}" method="GET">
                <label for="name">名前</label>
                <input type="text" name="name" id="name" class="admin-dashboard-input" value="{{ request('name') }}" placeholder="名前">
                <label for="phone">電話番号</label>
                <input type="text" name="phone" id="phone" class="admin-dashboard-input" value="{{ request('phone') }}" placeholder="電話番号">
                <label for="status">発送状況</label>
                <select name="status" id="status">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>すべて</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>未発送</option>
                    <option value="preparing" {{ request('status') == 'preparing' ? 'selected' : '' }}>発送準備中</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>発送済み</option>
                </select>
                <button type="submit" class="search-button">検索</button>
            </form>
        </div>
    </div>
    <section class="admin-dashboard-orders">
        <h3 class="admin-dashboard-section-title">注文状況一覧</h3>
        @if(isset($orders) && $orders->count() > 0)
        <table class="admin-dashboard-table">
            <thead>
                <tr>
                    <th>注文日時</th>
                    <th>注文者</th>
                    <th>フリガナ</th>
                    <th>発送状況</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                @if($order->status !== 'completed')
                <tr>
                    <td>{{ $order->created_at->format('Y/m/d H:i') }}</td>
                    <td>{{ $order->user_id ? $order->user->name : $order->name }}</td>
                    <td>{{ $order->user_id ? $order->user->furigana : $order->furigana }}</td>
                    <td>{{ $order->status_label }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="admin-dashboard-detail-button">詳細</a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        {{ $orders->links('pagination::admin') }}
        @else
        <p>注文データがありません。</p>
        @endif
    </section>
</main>
@endsection