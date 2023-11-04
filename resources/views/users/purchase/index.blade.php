@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>{{ Auth::user()->name }}</h1>
            <div class="d-flex justify-content-between my-2">
                <h2 class="m-0">Мои покупки</h2>
            </div>
        <hr class="py-1">
            <div class="list-group">
            @forelse($purchases as $purchase)
                @php $record = $purchase->record; @endphp
                @include('partial.record_list_item')
            @empty
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Нет купленых записей</h5>
                    <small class="text-body-secondary text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/>
                        </svg>
                    </small>
                </div>
            @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
