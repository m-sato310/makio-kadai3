@extends('layouts.loggedin')

@section('title', '目標体重設定')

@section('content')
<div class="management-container">
    <div class="card">
        <h1 class="page-title">目標体重設定</h1>

        <form action="/weight_logs/goal_setting" method="post">
            @csrf

            <div class="modal-form__group">
                <div class="input-with-unit">
                    <input type="text" name="target_weight" value="{{ old('target_weight', $target->target_weight) }}">
                    <span class="unit-label">kg</span>
                </div>
                @error('target_weight')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="modal-form__button-group">
                <a class="modal-btn-cancel" href="/weight_logs">戻る</a>
                <button class="modal-form__submit-btn" type="submit">更新</button>
            </div>
        </form>

    </div>
</div>
@endsection