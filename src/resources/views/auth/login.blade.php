@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')

<h2 class="auth__title">Login</h2>
@if(session('error'))
  <p style="color:red;">{{ session('error') }}</p>
@endif
<div class="auth">
  <form action="/login" method="post">
@csrf
    <p>メールアドレス</p>
    <input type="email"name="email" placeholder="例: test@example.com">
<div class="form__error">
  @error('email')
    {{ $message }}
  @enderror
</div>
    <p>パスワード</p>
    <input type="password" name="password" placeholder="例: coachtech1106">
<div class="form__error">
  @error('password')
    {{ $message }}
  @enderror
</div>
    <button type="submit">ログイン</button>
  </form>
</div>
@endsection