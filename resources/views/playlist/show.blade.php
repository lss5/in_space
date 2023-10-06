@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1 class="h4 my-2">Плейлист: {{ $playlist->name }}</h1>
            <hr class="py-1">
        @if($playlist->records->count() > 0)
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
                @forelse ($playlist->records as $record)
                    <tr>
                        <td>{{ $record->artist->name }}</td>
                        <td>
                        @if($record->artist)
                            <a href="{{ route('record.show', $record) }}">
                                {{ $record->name }}
                            </a>
                        @else
                            {{ __('artist.deleted') }}
                        @endif
                        </td>
                        <td>{{ $record->updated_at->format('d.m.Y') }}</td>
                        <td>
                            <a href="{{ route('record.out_playlist', [$record, $playlist]) }}" class="btn btn-danger">Удалить</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="col-12">
                <h5>Записи не добавлены</h5>
            </div>
        @endif
            <hr class="py-1">
{{--            <a href="{{ route('record.create') }}" class="btn btn-success mx-1">{{ __('button.add_record') }}</a>--}}
            <a href="{{ route('playlist.index') }}" class="btn btn-secondary mx-1">{{ __('button.to_list') }}</a>
            <a href="{{ route('playlist.edit', $playlist) }}" class="btn btn-warning mx-1">{{ __('button.edit') }}</a>
        </div>
    </div>
</div>
@endsection
