@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-4">
        <div class="col-12">
            <h1>Популярные записи</h1>
            <div class="list-group">
            @forelse($records as $record)
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <a href="{{ route('record.show', $record) }}" class="text-decoration-none d-flex flex-row align-items-center w-25">
                            <div class="me-3 d-flex flex-column align-items-center w-25">
                                @if($record->images->count() > 0)
                                    <img src="{{ asset('storage/'.$record->latestImage->link) }}" alt="" class="img img-fluid">
                                @else
                                    <img src="{{ asset('images/no_artist.jpeg') }}" alt="" class="img img-fluid">
                                @endif
                            </div>
                            <div class="w-75">
                                <h5 class="mb-1">{{ $record->name }}</h5>
                                <p class="mb-1">
                                    @isset($record->artist->name)
                                        {{ $record->artist->name }}
                                    @else
                                        Неизвестен
                                    @endisset
                                </p>
                                {{-- <small class="text-body-secondary">{{ $record->created_at->format('Y') }}</small> --}}
                                <small class="text-body-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
                                    </svg>
                                    {{ $record->plays()->sum('count') }}
                                </small>
                            </div>
                        </a>
                        <div class="w-50 d-flex align-items-center">
                            <audio controls class="w-100">
                                <source src="{{ asset('storage/'.$record->link) }}" type="audio/mpeg">
                                Тег audio не поддерживается вашим браузером.
                            </audio>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-between">
                            <small class="text-body-secondary">
                                Добавлен:
                                {{ $record->created_at->diffForHumans() }}
                            </small>
                            @if ($playlists)
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Плейлист
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note-list" viewBox="0 0 16 16">
                                            <path d="M12 13c0 1.105-1.12 2-2.5 2S7 14.105 7 13s1.12-2 2.5-2 2.5.895 2.5 2z"/>
                                            <path fill-rule="evenodd" d="M12 3v10h-1V3h1z"/>
                                            <path d="M11 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 16 2.22V4l-5 1V2.82z"/>
                                            <path fill-rule="evenodd" d="M0 11.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 .5 7H8a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 .5 3H8a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu">
                                        @forelse($playlists as $playlist)
                                            <li><a class="dropdown-item" href="{{ route('record.to_playlist', [$record, $playlist]) }}">{{ $playlist->name }}</a></li>
                                        @empty
                                            <li>Нет</li>
                                        @endforelse
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Нет записей</h5>
                    <small class="text-body-secondary text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note" viewBox="0 0 16 16">
                            <path d="M9 13c0 1.105-1.12 2-2.5 2S4 14.105 4 13s1.12-2 2.5-2 2.5.895 2.5 2z"/>
                            <path fill-rule="evenodd" d="M9 3v10H8V3h1z"/>
                            <path d="M8 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 13 2.22V4L8 5V2.82z"/>
                        </svg>
                    </small>
                </div>
            @endforelse
            <div class="list-group">
        </div>
    </div>

    <div class="row my-4">
        <h1>Популярные артисты</h1>
    @forelse($artists as $artist)
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                @if($artist->images()->count() > 0)
                    <img src="{{ asset('storage/'.$artist->latestImage->link) }}" alt="" class="card-img-top">
                @else
                    <img src="{{ asset('images/no_artist.png') }}" alt="" class="card-img-top">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $artist->name }}</h5>
                    <p class="card-text">{{ $artist->description }}</p>
                    <a href="{{ route('artist.show', $artist) }}" class="btn btn-secondary">Записей: {{ $artist->records()->count() }}</a>
                </div>
            </div>
        </div>
    @empty
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Нет артистов</h5>
            <small class="text-body-secondary text-muted">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note" viewBox="0 0 16 16">
                    <path d="M9 13c0 1.105-1.12 2-2.5 2S4 14.105 4 13s1.12-2 2.5-2 2.5.895 2.5 2z"/>
                    <path fill-rule="evenodd" d="M9 3v10H8V3h1z"/>
                    <path d="M8 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 13 2.22V4L8 5V2.82z"/>
                </svg>
            </small>
        </div>
    @endforelse
    </div>
</div>
@endsection
