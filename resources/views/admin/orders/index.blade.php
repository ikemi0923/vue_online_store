@extends('layouts.admin')

@section('title', '注文一覧')

@section('content')
@php
    $prefix = app()->environment('production') ? '/laravel' : '';
@endphp
<main class="orders-index-page">
    <div class="orders-index-container">
        <h2 class="orders-index-title">注文一覧</h2>
        <table class="orders-index-table">
            <thead>
                <tr>
                    <th>注文ID</th>
                    <th>注文者</th>
                    <th>ステータス</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>
                        @if($order->status === 'pending')
                        <span class="orders-status-pending">未発送</span>
                        @elseif($order->status === 'preparing')
                        <span class="orders-status-preparing">発送準備中</span>
                        @elseif($order->status === 'completed')
                        <span class="orders-status-completed">発送済み</span>
                        @else
                        <span class="orders-status-unknown">不明</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ $prefix }}{{ route('admin.orders.show', $order->id) }}" class="orders-detail-button">詳細</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="orders-pagination">
            {{ $orders->links('vendor.pagination.admin') }}
        </div>
    </div>
</main>
@endsection
