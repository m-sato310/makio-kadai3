@extends('layouts.app')

@section('title', '新規会員登録')

@section('body_class', 'auth-bg')

@section('content')
<div class="form-container">
    <img src="{{ asset('images/pigly.png') }}" alt="Piglyロゴ" class="logo-image">

    <h1 class="form-title">新規会員登録</h1>
    <p class="form-step">STEP1 アカウント情報の登録</p>

    <form action="/register" method="post">
        @csrf

        <div class="form-group">
            <label for="name">お名前</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="名前を入力">
            @error('name')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
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

        <button class="btn btn-submit" type="submit">次に進む</button>
    </form>
    
    <a class="link-to-login" href="/login">ログインはこちら</a>
</div>
@endsection