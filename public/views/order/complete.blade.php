@extends('layouts.app')

@section('title', '注文完了')

@section('content')
<div class="order-complete-wrapper">
    <div class="order-complete-thank-you">ARIGATO！</div>
    <p class="order-complete-message">ご注文の受付が完了しました。</p>
    <a href="{{ route('home') }}" class="order-complete-back-btn">トップページに戻る</a>
</div>
@endsection