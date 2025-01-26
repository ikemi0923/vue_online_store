@extends('layouts.app')

@section('title', 'ホームページ')

@section('content')
<section class="responsive-slider">
    <div class="responsive-slider-wrapper">
        <div class="responsive-slide">
            <img src="{{ asset('images/slider/image1.jpg') }}" alt="スライド画像1">
        </div>
        <div class="responsive-slide">
            <img src="{{ asset('images/slider/image2.jpg') }}" alt="スライド画像2">
        </div>
        <div class="responsive-slide">
            <img src="{{ asset('images/slider/image3.jpg') }}" alt="スライド画像3">
        </div>
        <div class="responsive-slide">
            <img src="{{ asset('images/slider/image4.jpg') }}" alt="スライド画像4">
        </div>
        <div class="responsive-slide">
            <img src="{{ asset('images/slider/image5.jpg') }}" alt="スライド画像5">
        </div>
        <div class="responsive-slide">
            <img src="{{ asset('images/slider/image6.jpg') }}" alt="スライド画像6">
        </div>
    </div>
</section>

<section class="products grid">
    <div class="product">
        <div class="product-item">
            <img src="{{ asset('images/products/product1.jpg') }}" alt="商品画像1">
            <div class="product-hover">
                <p>商品名1</p>
                <p>¥1,100</p>
            </div>
        </div>
        <div class="product-info">
            商品の説明テキストがここに入ります。
        </div>
    </div>
    <div class="product">
        <div class="product-item">
            <img src="{{ asset('images/products/product2.jpg') }}" alt="商品画像2">
            <div class="product-hover">
                <p>商品名2</p>
                <p>¥2,200</p>
            </div>
        </div>
        <div class="product-info">
            商品の説明テキストがここに入ります。
        </div>
    </div>
    <div class="product">
        <div class="product-item">
            <img src="{{ asset('images/products/product3.jpg') }}" alt="商品画像3">
            <div class="product-hover">
                <p>商品名3</p>
                <p>¥3,300</p>
            </div>
        </div>
        <div class="product-info">
            商品の説明テキストがここに入ります。
        </div>
    </div>

    <div class="product">
        <div class="product-item">
            <img src="{{ asset('images/products/product4.jpg') }}" alt="商品画像4">
            <div class="product-hover">
                <p>商品名4</p>
                <p>¥4,400</p>
            </div>
        </div>
        <div class="product-info">
            商品の説明テキストがここに入ります。
        </div>
    </div>
    <div class="product">
        <div class="product-item">
            <img src="{{ asset('images/products/product5.jpg') }}" alt="商品画像5">
            <div class="product-hover">
                <p>商品名5</p>
                <p>¥5,500</p>
            </div>
        </div>
        <div class="product-info">
            商品の説明テキストがここに入ります。
        </div>
    </div>
    <div class="product">
        <div class="product-item">
            <img src="{{ asset('images/products/product6.jpg') }}" alt="商品画像6">
            <div class="product-hover">
                <p>商品名6</p>
                <p>¥6,600</p>
            </div>
        </div>
        <div class="product-info">
            商品の説明テキストがここに入ります。
        </div>
    </div>
    <div class="product">
        <div class="product-item">
            <img src="{{ asset('images/products/product1.jpg') }}" alt="商品画像7">
            <div class="product-hover">
                <p>商品名7</p>
                <p>¥7,700</p>
            </div>
        </div>
        <div class="product-info">
            商品の説明テキストがここに入ります。
        </div>
    </div>


</section>

<section class="campaign-banner" style="margin: 0; padding: 0;">
    <a href="#" style="display: block; margin: 0; padding: 0;">
        <img src="{{ asset('images/banners/campaign-banner.jpg') }}" alt="キャンペーンバナー" style="width: 100%; height: auto; display: block; margin: 0; padding: 0;">
    </a>
</section>


@endsection