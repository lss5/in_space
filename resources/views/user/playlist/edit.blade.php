@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1 class="h4 my-2">{{ $playlist->name }}</h1>
            <hr class="py-1">
            <form method="POST" action="{{ route('user.playlist.update', $playlist) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label for="name">Название</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('name')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                        <input name="name" value="{{ old('name') ??  $playlist->name }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp">
                        <small class="form-text text-muted">Название плейлиста</small>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label for="description">Описание</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('description')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="5">{{ old('description') }}</textarea>
                        <small class="form-text text-muted">Описание</small>
                    </div>
                </div>

                <hr class="pb-1">
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success mx-1" role="button" aria-pressed="true">{{ __('button.save') }}</button>
                        <a href="{{ route('user.playlist.show', $playlist) }}" class="btn btn-secondary mx-1">{{ __('button.back') }}</a>
                        <a type="button" class="btn btn-danger mx-1"
                                onclick="event.preventDefault();
                                document.getElementById('delete_form').submit();">
                            {{ __('button.delete') }}
                        </a>
                    </div>
                </div>
            </form>
            <form id="delete_form" action="{{ route('user.playlist.destroy', $playlist) }}" method="POST" class="d-none">
                @method('DELETE')
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
