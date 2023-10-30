@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1 class="h4 my-2">Создать плейлист</h1>
            <hr class="py-1">
            <form method="POST" action="{{ route('playlist.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- <div class="row my-2">
                    <div class="col-sm-12 col-lg-3">
                        <label class="mb-0">Обложка плейлиста</label>
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
                                </div>

                                <small class="form-text text-muted">{{ __('artist.form_image_prompt') }}</small>
                            </div>
                        </div>
                    </div>
                </div> -->

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
                        <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp">
                        <small class="form-text text-muted">Введите название плейлиста</small>
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
                        <small class="form-text text-muted">Описание плейлиста (на прогулку, для занятий спортом и т.д.)</small>
                    </div>
                </div>

                <hr class="pb-1">

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success mx-1" role="button" aria-pressed="true">{{ __('button.add') }}</button>
                        <a href="{{ route('user.artist.index') }}" class="btn btn-secondary mx-1" role="button" aria-pressed="false">{{ __('button.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
