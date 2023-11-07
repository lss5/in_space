@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row bg-white py-5">
            <div class="col-12 col-lg-8 mx-auto">
                <h1 class="h4 my-2">Запись: {{ $record->name }}</h1>
                <hr class="py-1">
                <form method="POST" action="{{ route('admin.record.update', $record) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row my-2">
                        <div class="col-sm-12 col-lg-3">
                            <label for="name">{{ __('record.form_create_name') }}</label>
                        </div>
                        <div class="col-sm-12 col-lg-9 form-group">
                            @error('name')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <input name="name" value="{{ old('name') ??  $record->name }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp">
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-sm-12 col-lg-3">
                            <label for="status">Статус</label>
                        </div>
                        <div class="col-sm-12 col-lg-9 form-group">
                            @error('status')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" aria-describedby="statusHelp">
                                @foreach ($statuses as $key => $value)
                                    <option value="{{ $key }}" @if(old('status') == $key || $record->status == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-sm-12 col-lg-3">
                            <label>Доступ</label>
                        </div>
                        <div class="col-sm-12 col-lg-9 form-group">
                            @error('publicity')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <select class="form-select @error('publicity') is-invalid @enderror" aria-describedby="ContentTypeHelp" name="publicity" id="publicity">
                                @foreach ($publicity as $key => $value)
                                    <option value="{{ $key }}" @if(old('publicity') == $key || $record->publicity == $key) selected @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Доступность записи</small>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-sm-12 col-lg-3">
                            <label for="artist">Жанр</label>
                        </div>
                        <div class="col-sm-12 col-lg-9 form-group">
                            @error('genre')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                            <select class="form-select @error('genre') is-invalid @enderror" name="genre[]" id="genre" multiple size="4" aria-label="Genre">
                                @foreach ($genres as $genre)
                                    <option value="{{ $genre->id }}" @if(collect(old('genre'))->contains($genre->id) || $record->genres->pluck('id')->contains($genre->id)) selected @endif>{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="pb-1">

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success mx-1" role="button" aria-pressed="true">{{ __('button.save') }}</button>
                            <a href="{{ route('admin.record.index', $record) }}" class="btn btn-secondary mx-1">{{ __('button.back') }}</a>
                            <a type="button" class="btn btn-danger mx-1"
                               onclick="event.preventDefault();
                                document.getElementById('delete_form').submit();">
                                {{ __('button.delete') }}
                            </a>
                        </div>
                    </div>
                </form>
                <form id="delete_form" action="{{ route('admin.record.destroy', $record) }}" method="POST" class="d-none">
                    @method('DELETE')
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
