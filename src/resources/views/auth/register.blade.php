@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<h2 class="auth__title">Register</h2>

<div class="auth">
    <form action="/register" method="post">
@csrf

    <p>お名前</p>
    <input type="text" name="name" placeholder="例: 山田 太郎">
@error('name')
  <p class="auth__error">{{ $message }}</p>
@enderror

    <p>メールアドレス</p>
    <input type="email" name="email" placeholder="例: test@example.com">
@error('email')
  <p class="auth__error">{{ $message }}</p>
@enderror

    <p>パスワード</p>
    <input type="password" name="password" placeholder="例: coachtech1106">
@error('password')
  <p class="auth__error">{{ $message }}</p>
@enderror

    <button type="submit">登録</button>
  </form>
</div>
@endsection