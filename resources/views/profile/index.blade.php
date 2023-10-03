@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>{{ __('profile.title') }}</h1>
            Имя: {{ $profile->name }}
            <hr class="py-1">
        @if($profile->images()->count() > 0)
            <img src="{{ asset('storage/'.$profile->latestImage->link) }}" class="img-thumbnail">
        @endif
            <h2><a href="{{ route('artist.index') }}">{{ __('artist.menu_name') }}</a>: {{ $artists->count() }}</h2>
        @if($artists->count() > 0)
            <h3>Последнее добавление: {{ $artists->first()->created_at }}</h3>
        @else
            <div class="col-12">
                <h5>Записи не созданы</h5>
            </div>
        @endif

            <h2><a href="{{ route('record.index') }}">{{ __('record.menu_name') }}</a>: {{ $records->count() }}</h2>
        @if($records->count() > 0)
{{--            @dd($records)--}}
            <h3>Последнее добавление: {{ $records->first()->created_at }}</h3>
        @else
            <div class="col-12">
                <h5>Записи не созданы</h5>
            </div>
        @endif
        </div>
    </div>
</div>
@endsection
