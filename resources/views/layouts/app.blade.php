<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="py-2 bg-body-tertiary border-bottom">
            <div class="container d-flex flex-wrap">
                <ul class="nav me-auto">
                    <li class="nav-item"><a href="{{ route('index') }}" class="nav-link link-body-emphasis px-2 active" aria-current="page">{{ __('menu.home') }}</a></li>
                    <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">{{ __('menu.music') }}</a></li>
                    <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">{{ __('menu.video') }}</a></li>
                    <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">{{ __('menu.faq') }}</a></li>
                    <li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">{{ __('menu.about') }}</a></li>
                </ul>
                <ul class="nav">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link link-body-emphasis px-2">{{ __('menu.login') }}</a></li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link link-body-emphasis px-2">{{ __('menu.register') }}</a></li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a href="{{ route('profile.index') }}" class="dropdown-item">{{ __('profile.menu_name') }}</a>
                                <a href="{{ route('artist.index') }}" class="dropdown-item">{{ __('artist.menu_name') }}</a>
                                <a href="{{ route('record.index') }}" class="dropdown-item">{{ __('record.menu_name') }}</a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('menu.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <main class="m-0">
            @yield('content')
        </main>
    </div>
</body>
</html>
