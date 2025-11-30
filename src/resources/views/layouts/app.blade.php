<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div class="header-utilities">
                <a href="/">
                    <img src="{{ asset('storage/logo/Logo.png') }}" alt="ロゴ画像">
                </a>
                <form action="{{ route('item.index') }}" method="GET" class="header__search-form">
                    <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="なにをお探しですか？">
                    @if(request()->query('data'))
                        <input type="hidden" name="data" value="{{ request()->query('data') }}">
                    @endif
                </form>
                <nav>
                    <ul class="header-nav">
                        @if (Auth::check())
                        <li class="header-nav__item">
                            <form class="form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">ログアウト</button>
                            </form>
                        </li>
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="{{ route('mypage.index') }}">マイページ</a>
                        </li>
                        <li class="header-nav__item--sel">
                            <a class="header-nav__item--sel--inner" href="{{ route('item.sell') }}">出品</a>
                        </li>
                        @else
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="{{ route('login.show') }}">ログイン</a>
                        </li>
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="{{ route('login.show') }}">マイページ</a>
                        </li>
                        <li class="header-nav__item--sel">
                            <a class="header-nav__item--sel--inner" href="{{ route('login.show') }}">出品</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    <main>
    @yield('content')
    </main>
</body>

</html>
