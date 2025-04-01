<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>初期体重登録</title>
</head>
<body>
    <h1>初期体重登録</h1>

    <form action="/register/step2" method="post">
        @csrf

        <div>
            <label>現在の体重</label>
            <input type="text" name="current_weight" value="{{ old('current_weight') }}">
            @error('current_weight')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>目標体重</label>
            <input type="text" name="target_weight" value="{{ old('target_weight') }}">
            @error('target_weight')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">アカウント作成</button>
    </form>
</body>
</html>