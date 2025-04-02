<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>情報更新画面</title>
</head>

<body>
    <h1>情報更新</h1>

    <a href="/weight_logs/goal_setting">目標体重設定</a>

    <form action="/logout" method="post">
        @csrf
        <button type="submit">ログアウト</button>
    </form>

    <form action="/weight_logs/{{ $log->id }}/update" method="post">
        @csrf

        <div>
            <label>日付</label>
            <input type="date" name="date" value="{{ old('date',\Carbon\Carbon::today()->toDateString()) }}">
            @error('date')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>体重</label>
            <input type="text" name="weight" value="{{ old('weight',$log->weight) }}">
            @error('weight')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>摂取カロリー</label>
            <input type="text" name="calories" value="{{ old('calories',$log->calories) }}">
            @error('calories')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>運動時間</label>
            <input type="time" name="exercise_time" value="{{ old('exercise_time',$log->exercise_time) }}">
            @error('exercise_time')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>運動内容</label>
            <textarea name="exercise_content">{{ old('exercise_content', $log->exercise_content) }}</textarea>
            @error('exercise_content')
            <p style="color: red;">{{ $$message }}</p>
            @enderror
        </div>

        <button type="submit">更新</button>
    </form>

    <form action="/weight_logs/{{ $log->id }}/delete" method="post" style="display: inline;">
        @csrf
        <button type="submit">
            <img src="{{ asset('images/trash.png') }}" alt="削除" width="24" height="24">
        </button>
    </form>

    <a href="/weight_logs">戻る</a>
</body>

</html>