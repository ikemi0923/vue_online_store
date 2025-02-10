@extends('layouts.admin')

@section('title', '注文一覧ページ')

@section('content')

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
                        @elseif($order->status === 'shipped')
                        <span class="orders-status-shipped">発送済み</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="orders-detail-button">
                            詳細
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="orders-pagination">
            @if ($orders->lastPage() > 1)
            <ul class="pagination">
                {{-- 前へボタン --}}
                @if ($orders->onFirstPage())
                <li class="disabled"><span>«</span></li>
                @else
                <li><a href="{{ $orders->previousPageUrl() }}" rel="prev">«</a></li>
                @endif

                {{-- ページ番号（モバイルでは非表示） --}}
                <span class="pagination-numbers">
                    @for ($i = 1; $i <= $orders->lastPage(); $i++)
                        @if ($i == $orders->currentPage())
                        <li class="active"><span>{{ $i }}</span></li>
                        @elseif ($i == 1 || $i == $orders->lastPage() || abs($orders->currentPage() - $i) <= 1)
                            <li><a href="{{ $orders->url($i) }}">{{ $i }}</a></li>
                            @elseif ($i == 2 || $i == $orders->lastPage() - 1)
                            <li><span>...</span></li>
                            @endif
                            @endfor
                </span>

                {{-- 次へボタン --}}
                @if ($orders->hasMorePages())
                <li><a href="{{ $orders->nextPageUrl() }}" rel="next">»</a></li>
                @else
                <li class="disabled"><span>»</span></li>
                @endif
            </ul>
            @endif
        </div>

    </div>
</main>

@endsection