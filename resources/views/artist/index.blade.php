@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>{{ $user->name }}</h1>
            <hr class="py-1">

            <div class="d-flex justify-content-between my-2">
                <h2 class="m-0">{{ __('artist.menu_name') }}</h2>
                <a href="{{ route('artist.create') }}" type="button" class="btn btn-success">{{ __('button.create') }}</a>
            </div>

            @if($artists->count() > 0)
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
                    @forelse ($artists as $artist)
                        <tr>
                        <th scope="row">{{ $artist->id }}</th>
                        <td><a href="{{ route('artist.show', $artist) }}">{{ $artist->name }}</a></td>
                        <td>{{ $artist->user->name }}</td>
                        <td>{{ $artist->records->count() }}</td>
                        <td>{{ $artist->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="col-12">
                    <h5>Записи не созданы</h5>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
