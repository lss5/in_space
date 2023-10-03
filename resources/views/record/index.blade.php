@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>{{ $user->name }}</h1>
            <hr class="py-1">

            <h2>{{ __('record.menu_name') }}</h2>
            @if($records->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Артист</th>
                        <th scope="col">Название</th>
                        <th scope="col">Дата добавления</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($records as $record)
                        <tr>
                        <th scope="row">{{ $record->id }}</th>
                        <td>
                            @if($record->artist)
                                {{ $record->artist->name }}
                            @else
                                {{ __('artist.deleted') }}
                            @endif
                        </td>
                        <td><a href="{{ route('record.show', $record) }}">{{ $record->name }}</a></td>
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
        </div>
    </div>
</div>
@endsection
