<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録 - Step1</title>
</head>

<body>
    <h1>新規会員登録</h1>

    <form action="/register" method="post">
        @csrf

        <div>
            <label>お名前</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>メールアドレス</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label>パスワード</label>
            <input type="password" name="password">
            @error('password')
            <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">次に進む</button>
    </form>

    <a href="/login">ログインはこちら</a>
</body>

</html>