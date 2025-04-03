@extends('layouts.loggedin')

@section('title', '体重管理')

@section('content')
<div class="management-container">

    <div class="summary-wrapper">
        <div class="weight-summary">
            <div class="summary-item">
                <span class="label">目標体重</span>
                <span class="value">{{ $target->target_weight }}kg</span>
            </div>
            <div class="summary-item">
                <span class="label">目標まで</span>
                <span class="value">
                    @php
                    $diff = $latestWeightLog->weight - $target->target_weight;
                    @endphp
                    {{ $diff > 0 ? '-' . number_format($diff, 1) : '0.0' }}kg
                </span>
            </div>
            <div class="summary-item">
                <span class="label">最新体重</span>
                <span class="value">{{ $latestWeightLog->weight }}kg</span>
            </div>
        </div>
    </div>

    <div class="table-wrapper">
        <div class="search-add-wrapper">
            <form class="search-form" action="/weight_logs/search" method="get">
                <input type="date" name="from" value="{{ request('from') }}">
                <span class="date-separator">〜</span>
                <input type="date" name="to" value="{{ request('to') }}">
                <button class="btn-search" type="submit">検索</button>

                @if(request('from') || request('to'))
                <a class="btn-reset" href="/weight_logs">リセット</a>
                @endif
            </form>

            <a class="btn-submit" href="#weightLogModal">データを追加</a>
        </div>

        @if(isset($searchMessage))
        <p class="search-message">{{ $searchMessage }}</p>
        @endif

        <hr>


        <table class="weight-log-table">
            <thead>
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>食事摂取カロリー</th>
                    <th>運動時間</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                <tr class="weight-log-item">
                    <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                    <td>{{ $log->weight }}kg</td>
                    <td>{{ $log->calories ?? '-' }}cal</td>
                    <td>
                        {{ $log->exercise_time ? \Carbon\Carbon::createFromFormat('H:i:s', $log->exercise_time)->format('H:i') : '-' }}
                    </td>
                    <td>
                        <a href="/weight_logs/{{ $log->id }}">
                            <img src="{{ asset('images/pencil.png') }}" alt="編集" width="24" height="24">
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        <div class="pagination">
            {{ $logs->links() }}
        </div>
    </div>


    <div class="modal" id="weightLogModal">
        <a href="#!" class="modal-overlay"></a>
        <div class="modal__inner">
            <div class="modal__content">
                <h2 class="modal-title">Weight Logを追加</h2>
                <form action="/weight_logs/create" method="post">
                    @csrf

                    <div class="modal-form__group">
                        <label for="" class="modal-form__label">日付 <span class="required">必須</span></label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
                        @error('date')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="modal-form__group">
                        <label for="" class="modal-form__label">体重 <span class="required">必須</span></label>
                        <div class="input-with-unit">
                            <input type="text" name="weight" value="{{ old('weight') }}">
                            <span class="unit-label">kg</span>
                        </div>
                        @error('weight')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="modal-form__group">
                        <label class="modal-form__label">摂取カロリー <span class="required">必須</span></label>
                        <div class="input-with-unit">
                            <input type="text" name="calories" value="{{ old('calories') }}">
                            <span class="unit-label">cal</span>
                        </div>
                        @error('calories')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="modal-form__group">
                        <label class="modal-form__label">運動時間 <span class="required">必須</span></label>
                        <input type="time" name="exercise_time" value="{{ old('exercise_time') }}">
                        @error('exercise_time')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="modal-form__group">
                        <label class="modal-form__label">運動内容</label>
                        <textarea name="exercise_content">{{ old('exercise_content') }}</textarea>
                        @error('exercise_content')
                        <p class="error-message">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="modal-form__button-group">
                        <a href="#" class="modal-btn-cancel">戻る</a>
                        <input class="modal-form__submit-btn" type="submit" value="登録">
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection