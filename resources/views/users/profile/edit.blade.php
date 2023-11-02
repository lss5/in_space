@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>{{ __('profile.title') }}</h1>
            <form method="POST" action="{{ route('user.profile.update', ['user'=> $profile]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="image" class="form-label">Фотография профиля</label>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                @error('image')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('profile.form_email') }}</label>
                    <input class="form-control" type="text" id="email" value="{{ $profile->email }}" aria-label="{{ __('profile.form_email_prompt') }}" disabled readonly>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('profile.form_name') }}</label>
                    <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $profile->name }}">
                @error('name')
                    <div class="form-text">{{ $message }}</div>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Фамилия</label>
                    <input type="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ $profile->last_name }}">
                @error('last_name')
                    <div class="form-text">{{ $message }}</div>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('profile.form_description') }}</label>
                    <textarea class="form-control" name="description" rows="3">{{ $profile->description }}</textarea>
                    <div id="descriptionHelpBlock" class="form-text">{{ __('profile.form_description_prompt') }}</div>
                </div>
                <!-- Buttons -->
                <button type="submit" class="btn btn-success mx-1" role="button" aria-pressed="true">{{ __('profile.btn_save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
