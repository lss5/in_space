@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1 class="h4 my-2">{{ __('record.form_create_title') }}</h1>
            <hr class="py-1">
            <form method="POST" action="{{ route('user.record.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label class="mb-0">Запись</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('record')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <input type="file" name="record" id="record" accept=".mp3,.ogg,.flac,.mpeg,.ogg,.mp4,.webm,.3gp,.mov,.flv,.avi,.wmv" class="form-control @error('record') is-invalid @enderror">
                        <small class="form-text text-muted">Файл записи (mp3, ogg, flac, mpeg, ogg, mp4, webm, 3gp, mov, flv, avi, wmv)</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-lg-3">
                        <label>{{ __('record.form_create_artist') }}</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('artist')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <select class="form-select @error('artist') is-invalid @enderror" name="artist" id="artist">
                            @foreach ($artists as $artist)
                                <option value="{{ $artist->id }}" @if(old('artist') == $artist->id) selected @endif>{{ $artist->name }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Выберите Артиста из списка доступных</small>
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
                        <input name="year" value="{{ old('year') }}" type="number" min="1920" max="2030" class="form-control @error('year') is-invalid @enderror" id="year">
                        <small class="form-text text-muted">Год издания</small>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label>{{ __('record.form_create_name') }}</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name">
                        <small class="form-text text-muted">{{ __('record.form_create_name_prompt') }}</small>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label>{{ __('record.form_create_description') }}</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('description')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="4">{{ old('description') }}</textarea>
                        <small class="form-text text-muted">{{ __('record.form_create_description_prompt') }}</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-lg-3">
                        <label>Жанр</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('genre')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <select class="form-select @error('genre') is-invalid @enderror" name="genre[]" id="genre" multiple size="5" aria-label="Genre">
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" @if(collect(old('genre'))->contains($genre->id)) selected @endif>{{ $genre->name }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Выберите один или несколько Жанров из списка доступных</small>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label class="mb-0">{{ __('record.form_create_image') }}</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                    @error('image')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                    <input type="file" name="image" id="image" accept=".jpeg,.png,.jpg,.gif,.svg,.webp" class="form-control @error('image') is-invalid @enderror">
                    <small class="form-text text-muted">{{ __('record.form_create_image_prompt') }}</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-lg-3">
                        <label>Доступ</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('publicity')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                        <select class="form-select @error('publicity') is-invalid @enderror" name="publicity" id="publicity">
                            @foreach ($publicity as $key => $value)
                                <option value="{{ $key }}" @if(old('publicity') == $key) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Доступность записи</small>
                    </div>
                </div>

                <hr class="pb-1">
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success mx-1" role="button" aria-pressed="true">{{ __('button.upload') }}</button>
                        <a href="{{ route('user.artist.index') }}" class="btn btn-secondary mx-1" role="button" aria-pressed="false">{{ __('button.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
