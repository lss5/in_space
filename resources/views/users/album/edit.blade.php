@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1 class="h4 my-2">Редактирование: {{ $album->title }}</h1>
            <hr class="py-1">
            <form method="POST" action="{{ route('user.album.update', $album) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12 col-lg-3">
                        <label for="title">{{ __('artist.form_name') }}</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('title')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                        <input name="title" value="{{ old('title') ?? $album->title}}" type="text" class="form-control @error('title') is-invalid @enderror" id="title">
                        <small class="form-text text-muted">Название альбома</small>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label class="mb-0">{{ __('artist.form_image') }}</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                @error('image')
                                    <small class="form-text text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                                <div class="input-group">
                                    <input type="file" name="image" id="image" accept=".jpeg,.png,.jpg,.gif,.svg,.webp" class="form-control" @error('image') is-invalid @enderror">
                                </div>
                                <small class="form-text text-muted">{{ __('artist.form_image_prompt') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label>Год</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('year')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <input name="year" value="{{ old('year') ?? $album->year}}" type="number" min="1920" max="2030" class="form-control @error('year') is-invalid @enderror" id="year">
                        <small class="form-text text-muted">Год издания</small>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label for="artists">Артисты</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('artists')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                        <select class="form-select @error('artists') is-invalid @enderror" name="artists[]" id="artists" multiple size="4" aria-label="artists">
                            @foreach ($artists as $artist)
                                <option value="{{ $artist->id }}" @if(collect(old('artists'))->contains($artist->id) || $album->artists->pluck('id')->contains($artist->id)) selected @endif>{{ $artist->name }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Выберите записи для альбома</small>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label for="records">Записи</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('records')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                        <select class="form-select @error('records') is-invalid @enderror" name="records[]" id="records" multiple size="8" aria-label="Records">
                            @foreach ($records as $record)
                                <option value="{{ $record->id }}" @if(collect(old('records'))->contains($record->id) || $album->records->pluck('id')->contains($record->id)) selected @endif>{{ $record->name }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Выберите записи для альбома</small>
                    </div>
                </div>

                <hr class="pb-1">

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success mx-1" role="button" aria-pressed="true">{{ __('button.save') }}</button>
                        <a href="{{ route('user.album.index') }}" class="btn btn-secondary mx-1" role="button" aria-pressed="false">{{ __('button.cancel') }}</a>
                        <a type="button" class="btn btn-danger mx-1"
                                onclick="event.preventDefault();
                                document.getElementById('delete_form').submit();">
                            {{ __('button.delete') }}
                        </a>
                    </div>
                </div>
            </form>
            <form id="delete_form" action="{{ route('user.album.destroy', $album) }}" method="POST" class="d-none">
                @method('DELETE')
                @csrf
            </form>
        </div>
    </div>
</div>

@endsection