@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>Все Артисты (модерация)</h1>
        <hr class="py-1">
            <div class="list-group">
            @forelse($artists as $artist)
                <a href="{{ route('admin.artist.edit', $artist) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $artist->name }}</h5>
                        <small class="text-body-secondary">Создан: {{ $artist->created_at->format('d.m.Y') }}</small>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <small class="">Статус: {{ $artist->status }}</small>
                        <small class="text-body-secondary">Записей: {{ $artist->records()->count() }}</small>
                    </div>
                </a>
            @empty
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Артисты не созданы</h5>
                        <small class="text-body-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note" viewBox="0 0 16 16">
                                <path d="M9 13c0 1.105-1.12 2-2.5 2S4 14.105 4 13s1.12-2 2.5-2 2.5.895 2.5 2z"/>
                                <path fill-rule="evenodd" d="M9 3v10H8V3h1z"/>
                                <path d="M8 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 13 2.22V4L8 5V2.82z"/>
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
