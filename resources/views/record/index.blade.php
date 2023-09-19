@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row my-2">
        <div class="col-12">
            <h1>{{ $user->name }}</h1>
            <h2>{{ __('record.menu_name') }}</h2>
            @if($records->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Название</th>
                        <th scope="col">Артист</th>
                        <th scope="col">Дата добавления</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($records as $record)
                        <tr>
                        <th scope="row">{{ $record->id }}</th>
                        <td>{{ $record->name }}</td>
                        <td>{{ $record->artist->name }}</td>
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
