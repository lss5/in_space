@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="d-flex flex-row">
                <div class="w-25 me-3">
                @if($album->images()->count() > 0)
                    <img src="{{ asset('storage/'.$album->latestImage->link) }}" alt="" class="img img-thumbnail img-fluid" style="width: 200px">
                @else
                    <img src="{{ asset('images/no_artist.png') }}" alt="" class="img img-thumbnail img-fluid">
                @endif
                </div>
                <div class="d-flex flex-column justify-content-between">
                    <h1 class="h4">Название альбома: {{ $album->title }}</h1>
                    Жанр:
                    @forelse($album->records->first()->genres as $gerne)
                        {{ $gerne->name }}
                    @empty
                        Неизвестен
                    @endforelse
                    <span>Год: {{ $album->year }}</span>
                    <div class="d-flex flex-row">
                    @can('update', $album)
                        <a href="{{ route('user.album.edit', $album) }}" class="btn btn-secondary mx-1">{{ __('button.edit') }}</a>
                        <a href="{{ route('user.album.create') }}" class="btn btn-secondary mx-1">Новый</a>
                        <a href="{{ route('user.album.index') }}" class="btn btn-outline-secondary mx-1">Мои Альбомы</a>
                    @endcan
                    </div>
                </div>
            </div>
            <hr class="py-1">

            <div class="list-group">
                @forelse($album->records as $record)
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
