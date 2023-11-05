<nav class="py-2 bg-body-tertiary border-bottom">
            <div class="container d-flex flex-wrap">
                <ul class="nav me-auto">
                    <li class="nav-item"><a href="{{ route('index') }}" class="nav-link link-body-emphasis px-2 active" aria-current="page">{{ __('menu.home') }}</a></li>
<li class="nav-item"><a href="{{ route('artist.index') }}" class="nav-link link-body-emphasis px-2">{{ __('menu.artists') }}</a></li>
<li class="nav-item"><a href="{{ route('record.index') }}" class="nav-link link-body-emphasis px-2">Записи</a></li>
<li class="nav-item"><a href="#" class="nav-link link-body-emphasis px-2">{{ __('menu.video') }}</a></li>
<li class="nav-item"><a href="{{ route('genre.record.index') }}" class="nav-link link-body-emphasis px-2">Жанры</a></li>
<li class="nav-item"><a href="{{ route('playlist.index') }}" class="nav-link link-body-emphasis px-2">Плейлисты</a></li>
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
                @if(Auth::user()->images()->count() > 0)
                    <img src="{{ asset('storage/'.Auth::user()->latestImage->link) }}" alt="mdo" width="32" height="32" class="rounded-circle">
                @endif
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a href="{{ route('user.profile.show') }}" class="dropdown-item">{{ __('profile.menu_name') }}</a>
                <a href="{{ route('user.artist.index') }}" class="dropdown-item">{{ __('artist.menu_name') }}</a>
                <a href="{{ route('user.record.index') }}" class="dropdown-item">{{ __('record.menu_name') }}</a>
                <a href="{{ route('user.playlist.index') }}" class="dropdown-item">{{ __('playlist.menu_name') }}</a>
                <a href="{{ route('user.purchase.index') }}" class="dropdown-item">Покупки</a>
                <a href="{{ route('user.like.index') }}" class="dropdown-item">Понравившиеся</a>
                <a href="{{ route('user.dislike.index') }}" class="dropdown-item">Не понравились</a>
                <a href="{{ route('user.profile.edit') }}" class="dropdown-item">{{ __('profile.menu_edit') }}</a>
                @can('moder')
                    <hr class="dropdown-divider">
                    <a href="{{ route('admin.artist.index') }}" class="dropdown-item">{{ __('artist.menu_name') }}</a>
                    <a href="{{ route('admin.record.index') }}" class="dropdown-item">{{ __('record.menu_name') }}</a>
                    <a href="{{ route('genre.index') }}" class="dropdown-item">Жанры</a>
                @endcan
                @can('admin')
                    <a href="{{ route('admin.user.index') }}" class="dropdown-item">Пользователи</a>
                @endcan
                <hr class="dropdown-divider">
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
