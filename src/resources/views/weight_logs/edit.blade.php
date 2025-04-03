@extends('layouts.loggedin')

@section('title', '情報更新画面')

@section('content')
<div class="management-container">
    <div class="card">
        <h2 class="modal-title">Weight Log</h2>

        <form action="/weight_logs/{{ $log->id }}/update" method="post">
            @csrf

            <div class="modal-form__group">
                <label class="modal-form__label">日付</label>
                <input type="date" name="date" value="{{ old('date',\Carbon\Carbon::today()->toDateString()) }}">
                @error('date')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="modal-form__group">
                <label class="modal-form__label">体重</label>
                <div class="input-with-unit">
                    <input type="text" name="weight" value="{{ old('weight',$log->weight) }}">
                    <span class="unit-label">kg</span>
                </div>
                @error('weight')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="modal-form__group">
                <label class="modal-form__label">摂取カロリー</label>
                <div class="input-with-unit">
                    <input type="text" name="calories" value="{{ old('calories',$log->calories) }}">
                    <span class="unit-label">cal</span>
                </div>
                @error('calories')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="modal-form__group">
                <label class="modal-form__label">運動時間</label>
                <input type="time" name="exercise_time" value="{{ old('exercise_time',$log->exercise_time) }}">
                @error('exercise_time')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="modal-form__group">
                <label class="modal-form__label">運動内容</label>
                <textarea name="exercise_content">{{ old('exercise_content', $log->exercise_content) }}</textarea>
                @error('exercise_content')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="button-area">
                <div class="center-buttons">
                    <a class="modal-btn-cancel" href="/weight_logs">戻る</a>
                    <button class="modal-form__submit-btn" type="submit">更新</button>
                </div>
            </div>
        </form>

        <div class="delete-button-wrapper">
            <form action="/weight_logs/{{ $log->id }}/delete" method="post" class="delete-form">
                @csrf
                <button type="submit" class="btn-delete">
                    <img src="{{ asset('images/trash.png') }}" alt="削除" width="20">
                </button>
            </form>
        </div>

    </div>
</div>
@endsection