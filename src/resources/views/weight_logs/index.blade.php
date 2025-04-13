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

            @livewire('weight-log-modal')
        </div>

        @if(isset($searchMessage))
        <p class="search-message">{{ $searchMessage }}</p>
        @endif

        <hr>

        @livewire('weight-log-list')
    </div>
</div>
@endsection