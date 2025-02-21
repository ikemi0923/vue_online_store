<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '管理者ページ')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <div class="header-wrapper">
        <div class="logo">
            <img src="{{ asset('images/logo/logo.jpeg') }}" alt="ロゴ" />
        </div>
        <div class="header-title">
            <h1>Vue Online Site</h1>
        </div>
        <nav class="nav">
            <ul>
                <li><a href="{{ url('/admin/login') }}">ログイン</a></li>
            </ul>
        </nav>
    </div>

    <div class="order-management-header">
        <h1 class="order-management-title">@yield('pageTitle', '管理者ページ')</h1>
        <nav class="order-management-nav">
            <a href="{{ route('admin.dashboard') }}" class="order-management-link">管理者トップ</a>
            <a href="{{ route('admin.logout') }}" class="order-management-link"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                ログアウト
            </a>
        </nav>
    </div>

    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>


    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

</body>

</html>