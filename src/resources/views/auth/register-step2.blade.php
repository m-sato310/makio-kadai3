@extends('layouts.app')

@section('title', '初期体重登録')

@section('body_class', 'auth-bg')

@section('content')
<div class="form-container">
    <img src="{{ asset('images/pigly.png') }}" alt="Piglyロゴ" class="logo-image">

    <h1 class="form-title">新規会員登録</h1>
    <p class="form-step">STEP2 体重データの入力</p>

    <form action="/register/step2" method="post">
        @csrf

        <div class="form-group">
            <label for="current_weight">現在の体重</label>
            <div class="input-with-unit">
                <input type="text" name="current_weight" id="current_weight" value="{{ old('current_weight') }}" placeholder="現在の体重を入力">
                <span class="unit-label">kg</span>
            </div>
            @error('current_weight')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="target_weight">目標体重</label>
            <div class="input-with-unit">
                <input type="text" name="target_weight" id="target_weight" value="{{ old('target_weight') }}" placeholder="目標の体重を入力">
                <span class="unit-label">kg</span>
            </div>
            @error('target_weight')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <button class="btn btn-submit" type="submit">アカウント作成</button>
    </form>
</div>
@endsection