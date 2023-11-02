@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row bg-white py-5">
            <div class="col-12 col-lg-8 mx-auto">
                <h1 class="h4 my-2">{{ $record->name }}</h1>
                <hr class="py-1">
                <form method="POST" action="{{ route('user.record.update', $record) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-lg-3">
                            <label for="genre">Жанр</label>
                        </div>
                        <div class="col-sm-12 col-lg-9 form-group">
                            @error('genre')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <select class="form-select @error('genre') is-invalid @enderror" name="genre[]" id="genre" multiple size="4" aria-label="Genre">
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}" @if(collect(old('genre'))->contains($genre->id) || $record->genres->pluck('id')->contains($genre->id)) selected @endif>{{ $genre->name }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Выберите Жанр из списка доступных</small>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-sm-12 col-lg-3">
                            <label class="mb-0">{{ __('record.form_image') }}</label>
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
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                                    </div>

                                    <small class="form-text text-muted">{{ __('record.form_image_prompt') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-sm-12 col-lg-3">
                            <label for="name">{{ __('record.form_name') }}</label>
                        </div>
                        <div class="col-sm-12 col-lg-9 form-group">
                        @error('name')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                            <input name="name" value="{{ old('name') ??  $record->name }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp">
                            <small class="form-text text-muted">{{ __('record.form_name_prompt') }}</small>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-sm-12 col-lg-3">
                            <label for="description">{{ __('record.form_description') }}</label>
                        </div>
                        <div class="col-sm-12 col-lg-9 form-group">
                        @error('description')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="5">{{ old('description') }}</textarea>
                            <small class="form-text text-muted">{{ __('record.form_description_prompt') }}</small>
                        </div>
                    </div>

                    <hr class="pb-1">
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success mx-1" role="button" aria-pressed="true">{{ __('button.save') }}</button>
                            <a href="{{ route('user.record.show', $record) }}" class="btn btn-secondary mx-1">{{ __('button.back') }}</a>
                            <a type="button" class="btn btn-danger mx-1"
                               onclick="event.preventDefault();
                                document.getElementById('delete_form').submit();">
                                {{ __('button.delete') }}
                            </a>
                        </div>
                    </div>
                </form>
                <form id="delete_form" action="{{ route('user.record.destroy', $record) }}" method="POST" class="d-none">
                    @method('DELETE')
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
