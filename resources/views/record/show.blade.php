@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row bg-white py-5">
            <div class="col-12 col-lg-8 mx-auto">
                <h1 class="h4 my-2">Запись: {{ $record->name }}</h1>
                <p>Артист:
                    @if($record->artist)
                        <a href="{{ route('artist.show', $record->artist) }}">{{ $record->artist->name }}</a>
                    @else
                        {{ __('artist.deleted') }}
                    @endif
                </p>
                <p>Жанр: Неизвестен</p>
                <p>Год: {{ $record->created_at->format('Y') }}</p>
                @if($record->images()->count() > 0)
                    <img src="{{ asset('storage/'.$record->latestImage->link) }}" class="img-thumbnail" alt="">
                @endif
                <hr class="py-1">
                <div class="d-flex flex-row">
                    <a href="{{ route('record.edit', $record) }}" class="btn btn-warning mx-1">{{ __('button.edit') }}</a>
                    <a href="{{ route('record.index') }}" class="btn btn-secondary mx-1">{{ __('button.to_list') }}</a>
                    <div class="dropdown mx-1">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Добавить в плейлист
                        </button>
                        <ul class="dropdown-menu">
                            @forelse($playlists as $playlist)
                                <li><a class="dropdown-item" href="{{ route('record.to_playlist', [$record, $playlist]) }}">{{ $playlist->name }}</a></li>
                            @empty
                                <li>Плейлисты не созданы</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
