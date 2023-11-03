@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>{{ $profile->name }}</h1>
            <hr class="py-1">

            <h2 class="my-2"><a href="{{ route('user.artist.index') }}" class="text-decoration-none">Мои артисты: {{ $artists->count() }}</a></h2>
        @if($artists->count() > 0)
            <div class="list-group">
                @foreach($artists as $artist)
                    <a href="{{ route('user.artist.show', $artist) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        {{ $artist->name }}
                        <span class="badge bg-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-music-note" viewBox="0 0 16 16">
                                <path d="M9 13c0 1.105-1.12 2-2.5 2S4 14.105 4 13s1.12-2 2.5-2 2.5.895 2.5 2z"/>
                                <path fill-rule="evenodd" d="M9 3v10H8V3h1z"/>
                                <path d="M8 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 13 2.22V4L8 5V2.82z"/>
                            </svg>
                            {{ $artist->records()->count() }}
                        </span>
                    </a>
                @endforeach
            </div>
        @else
            Артисты не созданы
        @endif

            <h2 class="my-2"><a href="{{ route('user.record.index') }}" class="text-decoration-none">Мои записи: {{ $records->count() }}</a></h2>
        @if($records->count() > 0)
            <div class="list-group">
                @foreach($records as $record)
                    <a href="{{ route('record.show', $record) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        @isset($record->artist->name)
                            {{ $record->artist->name }}
                        @else
                            Неизвестен
                        @endisset
                         - {{ $record->name }}
                        <span class="badge bg-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                            {{ $record->likes()->count() }}
                        </span>
                    </a>
                @endforeach
            </div>
        @else
            Записи не созданы
        @endif

            <h2 class="my-2"><a href="{{ route('user.playlist.index') }}" class="text-decoration-none">Мои плейлисты: {{ $playlists->count() }}</a></h2>
            @if($playlists->count() > 0)
                <ul class="list-group">
                    @foreach($playlists as $playlist)
                        <a href="{{ route('user.playlist.show', $playlist) }}" class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $playlist->name }}
                            <span class="badge bg-secondary rounded-pill">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-music-note-list" viewBox="0 0 16 16">
                            <path d="M12 13c0 1.105-1.12 2-2.5 2S7 14.105 7 13s1.12-2 2.5-2 2.5.895 2.5 2z"/>
                            <path fill-rule="evenodd" d="M12 3v10h-1V3h1z"/>
                            <path d="M11 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 16 2.22V4l-5 1V2.82z"/>
                            <path fill-rule="evenodd" d="M0 11.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 .5 7H8a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 .5 3H8a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        {{ $playlist->records()->count() }}
                    </span>
                        </a>
                    @endforeach
                </ul>
            @else
                Плейлисты не созданы
            @endif

            <h2 class="my-2"><a href="{{ route('user.like.index') }}" class="text-decoration-none">Понравившиеся: {{ $liked->count() }}</a></h2>
            @if($liked->count() > 0)
                <ul class="list-group">
                    @foreach($liked as $like)
                        <a href="{{ route('record.show', $like->liked) }}" class="list-group-item d-flex justify-content-between align-items-center">
                            @isset($like->liked->artist->name)
                                {{ $like->liked->artist->name }}
                            @else
                                Неизвестен
                            @endisset
                            - {{ $like->liked->name }}
                            <span class="badge bg-secondary">{{ $like->liked->created_at->format('Y') }}</span>
                        </a>
                    @endforeach
                </ul>
            @else
                Нет понравившихся записей
            @endif
        </div>
    </div>
</div>
@endsection
