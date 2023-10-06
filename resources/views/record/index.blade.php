@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>{{ $user->name }}</h1>
            <hr class="py-1">
            <div class="d-flex justify-content-between my-2">
                <h2 class="m-0">{{ __('record.menu_name') }}</h2>
                <a href="{{ route('record.create') }}" type="button" class="btn btn-success">{{ __('button.add_record') }}</a>
            </div>

            @if($records->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Артист</th>
                        <th scope="col">Название</th>
                        <th scope="col">Дата добавления</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($records as $record)
                        <tr>
                        <th scope="row">{{ $record->id }}</th>
                        <td>
                            @if($record->artist)
                                <a href="{{ route('artist.show', $record->artist) }}">{{ $record->artist->name }}</a>
                            @else
                                {{ __('artist.deleted') }}
                            @endif
                        </td>
                        <td><a href="{{ route('record.show', $record) }}">{{ $record->name }}</a></td>
                        <td>{{ $record->updated_at }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Добавить в плейлист
                                </button>
                                <ul class="dropdown-menu">
                                    @forelse($playlists as $playlist)
                                        <li><a class="dropdown-item" href="{{ route('record.to_playlist', [$record, $playlist]) }}">{{ $playlist->name }}</a></li>
                                    @empty
                                        <li>Плейлисты не созданы</li>
                                    @endforelse
                                </ul>
                            </div>
                        </td>
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
