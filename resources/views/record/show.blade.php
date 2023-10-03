@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row bg-white py-5">
            <div class="col-12 col-lg-8 mx-auto">
                <h1 class="h4 my-2">Запись: {{ $record->name }}</h1>
                <p>Артист:
                    @if($record->artist)
                        {{ $record->artist->name }}
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
                <a href="{{ route('record.edit', $record) }}" class="btn btn-warning mx-1">{{ __('button.edit') }}</a>
                <a href="{{ route('record.index') }}" class="btn btn-secondary mx-1">{{ __('button.to_list') }}</a>
            </div>
        </div>
    </div>
@endsection
