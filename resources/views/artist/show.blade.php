@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1 class="h4 my-2">{{ $artist->name }}</h1>
            @if($artist->images()->count() > 0))
                <img src="{{ asset('storage/'.$artist->latestImage->link) }}" alt="">
            @endif
            <hr class="py-1">
        @if($records->count() > 0)
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Артист</th>
                    <th scope="col">Название</th>
                    <th scope="col">Дата добавления</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($records as $record)
                    <tr>
                        <td>
                            @if($record->artist)
                                {{ $record->artist->name }}
                            @else
                                {{ __('artist.deleted') }}
                            @endif
                        </td>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->updated_at }}</td>
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
