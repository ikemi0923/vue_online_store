@extends('layouts.admin')

@section('title', '管理者ログイン')

@section('content')
@php
    $prefix = app()->environment('production') ? '/laravel' : '';
@endphp
<div class="admin-login-wrapper">
  @if(session('success'))
  <script>
    alert("{{ session('success') }}");
  </script>
  @endif
  @if ($errors->any())
  <div class="popup-message error">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form action="{{ $prefix }}{{ route('admin.login.submit') }}" method="POST" class="admin-login-form">
    @csrf
    <div class="admin-login-form-group">
      <label for="email" class="admin-login-label">メールアドレス:</label>
      <input type="email" id="email" name="email" class="admin-login-input" placeholder="メールアドレスを入力" value="{{ old('email') }}" required />
    </div>
    <div class="admin-login-form-group">
      <label for="password" class="admin-login-label">パスワード:</label>
      <input type="password" id="password" name="password" class="admin-login-input" placeholder="パスワードを入力" required />
    </div>
    <button class="admin-login-button" type="submit">ログイン</button>
  </form>
</div>
@section('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function() {
    let popup = document.querySelector(".popup-message");
    if (popup) {
      setTimeout(() => {
        popup.style.opacity = "0";
        setTimeout(() => {
          popup.style.display = "none";
        }, 500);
      }, 3000);
    }
  });
</script>
@endsection
@endsection
