@php
    $prefix = app()->environment('production') ? '/laravel' : '';
@endphp
<div class="header-wrapper">
    <div class="logo">
        <img src="{{ $prefix }}{{ asset('images/logo/logo.jpeg') }}" alt="ロゴ" />
    </div>
    <div class="header-title">
        <h1>Vue Online Site</h1>
    </div>
    <nav class="nav">
        <ul>
            <li><a href="{{ $prefix }}{{ url('/cart') }}">カート</a></li>
        </ul>
    </nav>
</div>
