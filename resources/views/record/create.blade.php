@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1 class="h4 my-2">{{ __('record.form_create_title') }}</h1>
            <hr class="py-1">
            <form method="POST" action="{{ route('record.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-lg-3">
                        <label for="artist">{{ __('record.form_create_artist') }}</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('artist')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                        @enderror
                        <select class="form-select @error('artist') is-invalid @enderror" aria-describedby="artistHelp" name="artist" id="artist">
                            @foreach ($artists as $artist)
                                <option value="{{ $artist->id }}" @if(old('country') == $artist->id) selected @endif>{{ $artist->name }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Manufacturer your hardware</small>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label class="mb-0">{{ __('record.form_create_image') }}</label>
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
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image">
    {{--                                <label class="input-group-text" for="image">Upload</label>--}}
                                </div>

                                <small class="form-text text-muted">{{ __('record.form_create_image_prompt') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label for="name">{{ __('record.form_create_name') }}</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('name')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                        <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp">
                        <small class="form-text text-muted">{{ __('record.form_create_name_prompt') }}</small>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label for="description">{{ __('record.form_create_description') }}</label>
                    </div>
                    <div class="col-sm-12 col-lg-9 form-group">
                        @error('description')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="5">{{ old('description') }}</textarea>
                        <small class="form-text text-muted">{{ __('record.form_create_description_prompt') }}</small>
                    </div>
                </div>

                <hr class="pb-1">

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success mx-1" role="button" aria-pressed="true">{{ __('button.upload') }}</button>
                        <a href="{{ route('artist.index') }}" class="btn btn-secondary mx-1" role="button" aria-pressed="false">{{ __('button.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
