@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1 class="h4 my-2">Покупка записи: {{ $record->artist->name }} - {{ $record->name }}</h1>
            <hr class="py-1">
            <form method="POST" action="{{ route('user.purchase.store') }}">
                @csrf
                <input type="hidden" name="record" value="{{ $record->id }}">
                Шлюз платежной системы

                <hr class="pb-1">

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success mx-1" role="button" aria-pressed="true">Оплатить</button>
                        <a href="{{ route('record.show', $record) }}" class="btn btn-secondary mx-1" role="button" aria-pressed="false">{{ __('button.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
