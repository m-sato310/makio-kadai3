<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>体重管理</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>
    <h1>体重管理画面</h1>

    <div>
        <p>目標体重：{{ $target->target_weight }}kg</p>
        <p>最新体重：{{ $latestWeightLog->weight }}kg</p>
        @php
        $diff = $latestWeightLog->weight - $target->target_weight;
        @endphp

        @if ($diff > 0)
        <p>目標まで -{{ number_format($diff, 1) }}kg</p>
        @else
        <p>目標まで 0.0kg</p>
        @endif
    </div>

    <form action="/weight_logs/search" method="get">
        <label>開始日:<input type="date" name="from" value="{{ request('from') }}"></label>
        <label>終了日:<input type="date" name="to" value="{{ request('to') }}"></label>
        <button type="submit">検索</button>

        @if(request('from') || request('to'))
            <a href="/weight_logs">リセット</a>
        @endif
    </form>

    <a href="#weightLogModal">データを追加</a>

    <form action="/logout" method="post">
        @csrf
        <button type="submit">ログアウト</button>
    </form>

    @if(isset($searchMessage))
        <p>{{ $searchMessage }}</p>
    @endif

    <hr>

    <table border='1'>
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
            <tr>
                <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                <td>{{ $log->weight }}kg</td>
                <td>{{ $log->calories ?? '-' }}cal</td>
                <td>{{ $log->exercise_time ?? '-' }}</td>
                <td>
                    <a href="/weight_logs/{{ $log->id }}">
                        <img src="{{ asset('images/pencil.png') }}" alt="編集" width="24" height="24">
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $logs->links() }}
    </div>

    <div class="modal" id="weightLogModal">
        <a href="#!" class="modal-overlay"></a>
        <div class="modal__inner">
            <div class="modal__content">
                <form action="/weight_logs/create" method="post">
                    @csrf

                    <div class="modal-form__group">
                        <label for="" class="modal-form__label">日付</label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
                        @error('date')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="modal-form__group">
                        <label for="" class="modal-form__label">体重</label>
                        <input type="text" name="weight" value="{{ old('weight') }}">
                        @error('weight')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="modal-form__group">
                        <label class="modal-form__label">摂取カロリー</label>
                        <input type="text" name="calories" value="{{ old('calories') }}">
                        @error('calories')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="modal-form__group">
                        <label class="modal-form__label">運動時間</label>
                        <input type="time" name="exercise_time" value="{{ old('exercise_time') }}">
                        @error('exercise_time')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="modal-form__group">
                        <label class="modal-form__label">運動内容</label>
                        <textarea name="exercise_content">{{ old('exercise_content') }}</textarea>
                        @error('exercise_content')
                        <p style="color: red;">{{ $message }}</p>
                        @enderror
                    </div>

                    <input class="modal-form__delete-btn btn" type="submit" value="登録">
                </form>
            </div>

            <a href="#" class="modal__close-btn">戻る</a>
        </div>
    </div>
</body>

</html>