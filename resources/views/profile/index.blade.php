@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>{{ $profile->name }}</h1>
            <hr class="py-1">
            <h2 class="my-2"><a href="{{ route('playlist.index') }}" class="text-decoration-none">Мои плейлисты: {{ $playlists->count() }}</a></h2>
        @if($playlists->count() > 0)
            <ul class="list-group">
            @foreach($playlists as $playlist)
                <a href="{{ route('playlist.show', $playlist) }}" class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $playlist->name }}
                    <span class="badge bg-secondary rounded-pill">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note-list" viewBox="0 0 16 16">
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

            <h2 class="my-2"><a href="{{ route('like.index') }}" class="text-decoration-none">Понравившиеся: {{ $liked->count() }}</a></h2>
        @if($liked->count() > 0)
            <ul class="list-group">
                @foreach($liked as $like)
                    <a href="{{ route('record.show', $like->record) }}" class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $like->record->artist->name }} - {{ $like->record->name }}
                        <span class="badge bg-secondary">{{ $like->record->created_at->format('Y') }}</span>
                    </a>
                @endforeach
            </ul>
        @else
            Плейлисты не созданы
        @endif

            <h2 class="my-2"><a href="{{ route('artist.index') }}" class="text-decoration-none">Мои артисты: {{ $artists->count() }}</a></h2>
        @if($artists->count() > 0)
            <div class="list-group">
                @foreach($artists as $artist)
                    <a href="{{ route('artist.show', $artist) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        {{ $artist->name }}
                        <span class="badge bg-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-disc-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-6 0a2 2 0 1 0-4 0 2 2 0 0 0 4 0zM4 8a4 4 0 0 1 4-4 .5.5 0 0 0 0-1 5 5 0 0 0-5 5 .5.5 0 0 0 1 0zm9 0a.5.5 0 1 0-1 0 4 4 0 0 1-4 4 .5.5 0 0 0 0 1 5 5 0 0 0 5-5z"/>
                            </svg>
                            {{ $artist->records()->count() }}
                        </span>
                    </a>
                @endforeach
            </div>
        @else
            <div class="col-12">
                <h5>Артисты не созданы</h5>
            </div>
        @endif

            <h2 class="my-2"><a href="{{ route('record.index') }}" class="text-decoration-none">Мои записи: {{ $records->count() }}</a></h2>
        @if($records->count() > 0)
            <div class="list-group">
                @foreach($records as $record)
                    <a href="{{ route('record.show', $record) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        {{ $record->artist->name }} - {{ $record->name }}
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
            <div class="col-12">
                <h5>Записи не созданы</h5>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
