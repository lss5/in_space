@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row bg-white py-5">
            <div class="col-12 col-lg-8 mx-auto d-flex flex-column">
                <h1 class="h4 my-2">Покупка: {{ $purchase->record->name }}</h1>
                <p>Артист:
                    @if($purchase->record->artist)
                        <a href="{{ route('user.artist.show', $purchase->record->artist) }}">{{ $purchase->record->artist->name }}</a>
                    @else
                        {{ __('artist.deleted') }}
                    @endif
                </p>
                <p>Описание: {{ $purchase->record->description }}</p>
                <p>Жанр:
                @forelse($purchase->record->genres as $genre)
                    {{ $genre->name }}
                @empty
                    Неизвестен
                @endforelse
                </p>
                <p>Год: {{ $purchase->record->created_at->format('Y') }}</p>
                <audio controls class="w-100">
                    <source src="{{ asset('storage/'.$purchase->record->link) }}" type="audio/mpeg">
                    Тег audio не поддерживается вашим браузером.
                </audio>
                <hr class="py-1">
                <div class="d-flex flex-row align-items-center">
                {{-- @include('partial.playlist_button') --}}
                <a href="{{ route('user.purchase.download', $purchase) }}" class="btn btn-primary mx-1" role="button" aria-pressed="false">Скачать</a>
                @can('update', $purchase->record)
                    <a href="{{ route('user.record.edit', $purchase->record) }}" class="btn btn-secondary mx-1">{{ __('button.edit') }}</a>
                    <a href="{{ route('user.record.index') }}" class="btn btn-secondary mx-1">Все записи</a>
                @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
