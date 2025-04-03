@extends('layouts.app')

@section('title', 'ログイン')

@section('body_class', 'auth-bg')

@section('content')
<div class="form-container">
    <img src="{{ asset('images/pigly.png') }}" alt="Piglyロゴ" class="logo-image">

    <h1 class="form-title">ログイン</h1>

    <form action="/login" method="post">
        @csrf

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="メールアドレスを入力">
            @error('email')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" placeholder="パスワードを入力">
            @error('password')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button class="btn btn-submit" type="submit">ログイン</button>
    </form>

    <a class="link-to-login" href="/register/step1">アカウント作成はこちら</a>
</div>
@endsection