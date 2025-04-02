<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>目標体重設定</title>
</head>

<body>
    <h1>目標体重設定</h1>

    <form action="/weight_logs/goal_setting" method="post">
        @csrf

        <label>目標体重 (kg)</label>
        <input type="text" name="target_weight" value="{{ old('target_weight', $target->target_weight) }}">
        @error('target_weight')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <button type="submit">更新</button>
    </form>

    <a href="/weight_logs">戻る</a>
</body>

</html>