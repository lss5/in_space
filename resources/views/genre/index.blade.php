@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="d-flex justify-content-between my-2">
                <h2 class="m-0">Жанры</h2>
            </div>

            <hr class="py-1">

            <div class="list-group">
                @forelse($genres as $genre)
                    <a href="{{ route('genre.record.show', $genre) }}" class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $genre->name }}</h5>
                            <small class="text-body-secondary">Записей: {{ $genre->records()->count() }}</small>
                        </div>
                        <p class="mb-1">{{ $genre->description }}</p>
                    </a>
                @empty
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Нет жанров</h5>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
