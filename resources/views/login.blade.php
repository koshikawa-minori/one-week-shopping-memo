<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>ログイン画面</title>
</head>
<body>
    <div class="login-container">
        <h1>ログイン</h1>

        <form method="POST" action="/login">
            @csrf
            <label>パスワード</label>
            <input type="password" name="password" inputmode="numeric" pattern="[0-9]*" required>
            <button type="submit">ログイン</button>
        </form>
    </div>
</body>
</html>