@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex">
                    <h1 class="h4 m-0">Плейлист: {{ $playlist->name }}</h1>
                </div>
                <div class="d-flex">
                    <a href="{{ route('playlist.edit', $playlist) }}" class="btn btn-secondary mx-1">{{ __('button.edit') }}</a>
                    <a href="{{ route('playlist.index') }}" class="btn btn-outline-secondary mx-1">Все плейлисты</a>
                </div>
            </div>
            <hr class="py-1">

            <div class="list-group">
                @forelse($playlist->records as $record)
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
                                    <small class="text-body-secondary">{{ $record->created_at->format('Y') }}</small>
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
                                <a href="{{ route('record.out_playlist', [$record, $playlist]) }}" class="btn btn-sm btn-danger">Удалить</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Нет добавленых записей</h5>
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
    </div>
</div>
@endsection
