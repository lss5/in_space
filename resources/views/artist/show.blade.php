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
                    <span>Жанр:
                        @forelse($artist->genres as $genre)
                            <a href="{{ route('genre.record.show', $genre) }}">{{ $genre->name }}</a>
                        @empty
                            Неизвестен
                        @endforelse
                    </span>
                    <span>{{ $artist->description }}</span>
                    <div class="d-flex flex-row">
                    @can('update', $artist)
                        <a href="{{ route('user.artist.edit', $artist) }}" class="btn btn-secondary mx-1">{{ __('button.edit') }}</a>
                        <a href="{{ route('user.record.create') }}" class="btn btn-secondary mx-1">{{ __('button.add_record') }}</a>
                        <a href="{{ route('user.artist.index') }}" class="btn btn-outline-secondary mx-1">Все Артисты</a>
                    @endcan
                    </div>
                </div>
            </div>
        @if ($artist->albums->count() > 0)
            <hr class="py-1">
            <div class="row">
                <h4>Альбомы</h4>
                @foreach ($artist->albums as $album)
                <div class="col-12 col-lg-3">
                    <div class="card shadow-sm">
                        @if($album->images->count() > 0)
                        <img src="{{ asset('storage/'.$album->latestImage->link) }}" alt="{{ $album->title }}" class="bd-placeholder-img card-img-top">
                        @else
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>{{ $record->artist->name }} - {{ $record->name }}</title>
                            <rect width="100%" height="100%" fill="#55595c"></rect>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('album.show', $album) }}" class="text-decoration-none">{{ $album->title }}</a></h5>
                            <p class="card-text">{{ $album->year }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $album->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
            <hr class="py-1">
            <div class="list-group">
                @forelse($artist->records as $record)
                    @include('partial.record_list_item')
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
