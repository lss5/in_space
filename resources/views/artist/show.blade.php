@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="d-flex flex-row">
                <div class="w-25 me-3">
                @if($artist->images()->count() > 0)
                    <img src="{{ asset('storage/'.$artist->latestImage->link) }}" alt="" class="img img-thumbnail img-fluid" style="width: 200px">
                @else
                    <img src="{{ asset('images/no_artist.png') }}" alt="" class="img img-thumbnail img-fluid">
                @endif
                </div>
                <div class="d-flex flex-column justify-content-between">
                    <h1 class="h4">Артист: {{ $artist->name }}</h1>
                    Жанр:
                    @forelse($artist->genres as $gerne)
                        {{ $gerne->name }}
                    @empty
                        Неизвестен
                    @endforelse
                    <span>{{ $artist->description }}</span>
                    <div class="d-flex flex-row">
                        <a href="{{ route('artist.edit', $artist) }}" class="btn btn-secondary mx-1">{{ __('button.edit') }}</a>
                        <a href="{{ route('record.create') }}" class="btn btn-secondary mx-1">{{ __('button.add_record') }}</a>
                        <a href="{{ route('artist.index') }}" class="btn btn-outline-secondary mx-1">Все Артисты</a>
                    </div>
                </div>
            </div>
            <hr class="py-1">

            <div class="list-group">
                @forelse($artist->records as $record)
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <a href="{{ route('record.show', $record) }}" class="text-decoration-none d-flex flex-row align-items-center w-25">
                                <div class="me-3 d-flex flex-column align-items-center">
                                    @if($record->images->count() > 0)
                                        <img src="{{ asset('storage/'.$record->latestImage->link) }}" alt="" class="img img-fluid">
                                    @elseif($record->artist->images->count() > 0)
                                        <img src="{{ asset('storage/'.$record->artist->latestImage->link) }}" alt="" class="img img-fluid">
                                    @else
                                        <img src="{{ asset('images/no_artist.png') }}" alt="" class="img img-fluid">
                                    @endif
                                </div>
                                <div>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                        <path d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z"/>
                                    </svg>
                                    {{ $record->created_at->diffForHumans() }}
                                </small>
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
