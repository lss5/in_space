@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>{{ Auth::user()->name }}</h1>
            <div class="d-flex justify-content-between my-2">
                <h2 class="m-0">Мои плейлисты</h2>
                <a href="{{ route('user.playlist.create') }}" type="button" class="btn btn-secondary">{{ __('button.create') }}</a>
            </div>
            <hr class="py-1">

            <div class="list-group">
                @forelse($playlists as $playlist)
                    <a href="{{ route('user.playlist.show', $playlist) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $playlist->name }}</h5>
                            @if($playlist->records()->count() > 0)
                                <small class="text-body-secondary">Последнее изменение: {{ $playlist->records()->orderByPivot('created_at', 'desc')->first()->pivot->created_at->diffForHumans() }}</small>
                            @else
                                <small class="text-body-secondary">Нет записей</small>
                            @endif

                        </div>
                        <p class="mb-1">{{ $playlist->description }}</p>
                        <small class="text-body-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note-list" viewBox="0 0 16 16">
                                <path d="M12 13c0 1.105-1.12 2-2.5 2S7 14.105 7 13s1.12-2 2.5-2 2.5.895 2.5 2z"/>
                                <path fill-rule="evenodd" d="M12 3v10h-1V3h1z"/>
                                <path d="M11 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 16 2.22V4l-5 1V2.82z"/>
                                <path fill-rule="evenodd" d="M0 11.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 .5 7H8a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 .5 3H8a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            {{ $playlist->records->count() }}
                        </small>
                    </a>
                @empty
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Нет плейлистов</h5>
                            <small class="text-body-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note-list" viewBox="0 0 16 16">
                                    <path d="M12 13c0 1.105-1.12 2-2.5 2S7 14.105 7 13s1.12-2 2.5-2 2.5.895 2.5 2z"/>
                                    <path fill-rule="evenodd" d="M12 3v10h-1V3h1z"/>
                                    <path d="M11 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 16 2.22V4l-5 1V2.82z"/>
                                    <path fill-rule="evenodd" d="M0 11.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 .5 7H8a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 .5 3H8a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                            </small>
                        </div>
                    </a>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
