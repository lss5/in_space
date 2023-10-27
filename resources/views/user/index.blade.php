@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>Пользователи</h1>

            <hr class="py-1">

            <div class="list-group">
            @forelse($users as $user)
                <a href="{{ route('user.edit', $user) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $user->name }} {{ $user->last_name }}</h5>
                        <small class="text-body-secondary">Создан: {{ $user->created_at->format('d.m.Y') }}</small>
                    </div>
                    <p class="mb-1">
                        @forelse ($user->roles as $role)
                            {{ $role->name }}
                        @empty
                            Пользователь
                        @endforelse
                    </p>
                    <small class="text-body-secondary">Записей: {{ $user->records()->count() }}</small>
                </a>
            @empty
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Пользователей нет</h5>
                        <small class="text-body-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-music-note" viewBox="0 0 16 16">
                                <path d="M9 13c0 1.105-1.12 2-2.5 2S4 14.105 4 13s1.12-2 2.5-2 2.5.895 2.5 2z"/>
                                <path fill-rule="evenodd" d="M9 3v10H8V3h1z"/>
                                <path d="M8 2.82a1 1 0 0 1 .804-.98l3-.6A1 1 0 0 1 13 2.22V4L8 5V2.82z"/>
                            </svg>
                        </small>
                    </div>
                </a>
            @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
