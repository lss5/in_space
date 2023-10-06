@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>Плейлисты</h1>
            <hr class="py-1">

            <div class="d-flex justify-content-between my-2">
                <h2 class="m-0">Мои плейлисты</h2>
                <a href="{{ route('playlist.create') }}" type="button" class="btn btn-success">{{ __('button.create') }}</a>
            </div>

            @if($playlists->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Создал</th>
                        <th scope="col">Кол-во записей</th>
                        <th scope="col">Дата добавления</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($playlists as $playlist)
                        <tr>
                        <th scope="row">{{ $playlist->id }}</th>
                        <td><a href="{{ route('playlist.show', $playlist) }}">{{ $playlist->name }}</a></td>
                        <td>{{ $playlist->user->name }}</td>
                        <td>{{ $playlist->records->count() }}</td>
                        <td>{{ $playlist->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="col-12">
                    <h5>Плейлисты не созданы</h5>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
