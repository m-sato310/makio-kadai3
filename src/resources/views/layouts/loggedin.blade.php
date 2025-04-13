<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pigly')</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css')}}">
    @livewireStyles
</head>

<body class="@yield('body_class')">

    <header class="main-header">
        <div class="header-inner">
            <div class="header-left">
                <a href="/weight_logs">
                    <img class="header-logo" src="{{ asset('images/pigly.png') }}" alt="Piglyロゴ">
                </a>
            </div>

            <div class="header-right">
                <a href="/weight_logs/goal_setting">
                    <img class="header-icon" src="{{ asset('images/goal-icon.png') }}" alt="目標設定">
                </a>
                <form action="/logout" method="post">
                    @csrf
                    <button class="logout-button" type="submit">
                        <img class="header-icon" src="{{ asset('images/logout-icon.png') }}" alt="ログアウト">
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="container">
        @yield('content')
    </main>

    @livewireScripts
</body>

</html>