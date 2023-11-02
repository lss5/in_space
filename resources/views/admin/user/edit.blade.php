@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>
                @if($user->images()->count() > 0)
                    <img src="{{ asset('storage/'.$user->latestImage->link) }}" alt="mdo" width="48" height="48" class="rounded">
                @endif
                {{ $user->name }} {{ $user->last_name }}
            </h1>
            <form method="POST" action="{{ route('admin.user.update', ['user'=> $user]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- <div class="mb-3">
                    <label for="image" class="form-label">Фотография профиля</label>
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image">
                @error('image')
                    <small class="form-text text-danger">{{ $message }}</small>
                @enderror
                </div> --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $user->name }}">
                    @error('name')
                    <div class="form-text">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Фамилия</label>
                    <input type="last_name" class="form-control @error('name') is-invalid @enderror" name="last_name" id="last_name" value="{{ $user->last_name }}">
                    @error('last_name')
                    <div class="form-text">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-Mail</label>
                    <input class="form-control" type="text" value="{{ $user->email }}" aria-label="{{ __('user.form_email_prompt') }}" disabled readonly>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" name="description" rows="3">{{ $user->description }}</textarea>
                </div>
                {{-- roles --}}
                <div class="mb-3">
                @foreach ($roles as $role)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="roles[]" type="checkbox" id="role{{ $role->id }}" value="{{ $role->id }}"
                        @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                        <label class="form-check-label" for="role{{ $role->id }}">{{ $role->name }}</label>
                    </div>
                @endforeach
                </div>
                {{-- <!-- Buttons --> --}}
                <button type="submit" class="btn btn-success mx-1" role="button" aria-pressed="true">{{ __('button.save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
