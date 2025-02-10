@extends('layouts.app')

@section('title', 'ホームページ')

@section('content')
<section class="responsive-slider">
    <div class="responsive-slider-wrapper">
        @for ($i = 1; $i <= 6; $i++)
            <div class="responsive-slide">
            <img src="{{ asset('images/slider/image' . $i . '.jpg') }}" alt="スライド画像{{ $i }}">
    </div>
    @endfor
    </div>
</section>

<section class="products grid">
    @foreach ($products as $product)
    <div class="product">
        <div class="product-item">
            <a href="{{ route('products.show', $product->id) }}">
                <img src="{{ $product->getFirstImageUrlAttribute() }}" alt="{{ $product->name }}">
                <div class="product-hover">
                    <p>{{ $product->name }}</p>
                    <p>¥{{ number_format($product->price) }}</p>
                </div>
            </a>
        </div>
        <div class="product-info">
            {{ $product->description }}
        </div>
    </div>
    @endforeach
</section>

<section class="campaign-banner" style="margin: 0; padding: 0;">
    <a href="#" style="display: block; margin: 0; padding: 0;">
        <img src="{{ asset('images/banners/campaign-banner.jpg') }}" alt="キャンペーンバナー" style="width: 100%; height: auto; display: block; margin: 0; padding: 0;">
    </a>
</section>
@endsection