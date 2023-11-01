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
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                            <input name="name" value="{{ old('name') ??  $record->name }}" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 col-lg-3">
                            <label for="status">Статус</label>
                        </div>
                        <div class="col-sm-12 col-lg-9 form-group">
                            @error('status')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" aria-describedby="statusHelp">
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @if(old('status') == $status || $record->status == $status) selected @endif>{{ $status }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-sm-12 col-lg-3">
                            <label for="artist">Жанр</label>
                        </div>
                        <div class="col-sm-12 col-lg-9 form-group">
                            @error('genre')
                            <small class="form-text text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                            <select  name="genre" id="genre" class="form-select @error('genre') is-invalid @enderror" aria-describedby="artistHelp">
                                @foreach ($genres as $genre)
                                    @if($record->genres()->first())
                                        <option value="{{ $genre->id }}" @if(old('genre') == $genre->id || $record->genres()->first()->id == $genre->id) selected @endif>{{ $genre->name }}</option>
                                    @else
                                        <option value="{{ $genre->id }}" @if(old('genre') == $genre->id) selected @endif>{{ $genre->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="pb-1">

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success mx-1" role="button" aria-pressed="true">{{ __('button.save') }}</button>
                            <a href="{{ route('record.show', $record) }}" class="btn btn-secondary mx-1">{{ __('button.back') }}</a>
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
