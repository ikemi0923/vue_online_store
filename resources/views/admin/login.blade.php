@extends('layouts.admin')

@section('orderManagementNav')

@endsection

@section('title', '管理者ログイン')

@section('content')
<div class="admin-login-wrapper">
  <form class="admin-login-form">
    <div class="admin-login-form-group">
      <label for="email" class="admin-login-label admin-login-label-text">メールアドレス:</label>
      <input type="email" id="email" name="email" class="admin-login-input" placeholder="メールアドレスを入力してください" />
    </div>

    <div class="admin-login-form-group">
      <label for="password" class="admin-login-label admin-login-label-text">パスワード:</label>
      <input type="password" id="password" name="password" class="admin-login-input" placeholder="パスワードを入力してください" />
    </div>

    <button class="admin-login-button" type="submit">ログイン</button>
  </form>

</div>
@endsection