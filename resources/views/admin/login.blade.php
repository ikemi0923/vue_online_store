@extends('layouts.admin')

@section('orderManagementNav')

@endsection

@section('title', '管理者ログイン')

@section('content')
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

  <form action="{{ route('admin.login.submit') }}" method="POST" class="admin-login-form">
    @csrf
    <div class="admin-login-form-group">
      <label for="email" class="admin-login-label admin-login-label-text">メールアドレス:</label>
      <input type="email" id="email" name="email" class="admin-login-input" placeholder="メールアドレスを入力してください" value="{{ old('email') }}" />
    </div>

    <div class="admin-login-form-group">
      <label for="password" class="admin-login-label admin-login-label-text">パスワード:</label>
      <input type="password" id="password" name="password" class="admin-login-input" placeholder="パスワードを入力してください" />
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