<!DOCTYPE html>
<html lang="ja">

<head>
    @php
    $prefix = app()->environment('production') ? '/laravel' : '';
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vue Online Site')</title>
    <link rel="stylesheet" href="{{ $prefix }}{{ parse_url(asset('css/style.css'), PHP_URL_PATH) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('layouts.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')
</body>

</html>