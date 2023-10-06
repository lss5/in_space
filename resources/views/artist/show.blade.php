@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            @if($artist->images()->count() > 0)
                <img src="{{ asset('storage/'.$artist->latestImage->link) }}" alt="" class="img-thumbnail" style="width: 200px">
            @endif
            <h1 class="h4 my-2">Артист: {{ $artist->name }}</h1>
            <hr class="py-1">
        @if($records->count() > 0)
            <h2 class="h4">Записи: </h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Артист</th>
                    <th scope="col">Название</th>
                    <th scope="col">Дата добавления</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>
                        {{ $record->artist->name }}
                    </td>
                    <td>
                        <a href="{{ route('record.show', $record) }}">{{ $record->name }}</a>
                    </td>
                    <td>{{ $record->updated_at->format('Y') }}</td>
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
            <hr class="py-1">
            <a href="{{ route('record.create') }}" class="btn btn-success mx-1">{{ __('button.add_record') }}</a>
            <a href="{{ route('artist.index') }}" class="btn btn-secondary mx-1">{{ __('button.to_list') }}</a>
            <a href="{{ route('artist.edit', $artist) }}" class="btn btn-warning mx-1">{{ __('button.edit') }}</a>
        </div>
    </div>
</div>
@endsection
