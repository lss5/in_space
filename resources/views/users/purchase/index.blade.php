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
                <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <a href="{{ route('user.purchase.show', $purchase) }}" class="text-decoration-none d-flex flex-row align-items-center w-25">
                            <div class="me-3 d-flex flex-column align-items-center w-25">
                                @if($purchase->record->images->count() > 0)
                                    <img src="{{ asset('storage/'.$purchase->record->latestImage->link) }}" alt="" class="img img-fluid">
                                @else
                                    <img src="{{ asset('images/no_artist.jpeg') }}" alt="" class="img img-fluid">
                                @endif
                            </div>
                            <div class="w-75">
                                <h5 class="mb-1">{{ $purchase->record->name }}</h5>
                                <p class="mb-1">
                                    @isset($purchase->record->artist->name)
                                        {{ $purchase->record->artist->name }}
                                    @else
                                        Неизвестен
                                    @endisset
                                </p>
                                {{-- <small class="text-body-secondary">{{ $purchase->record->created_at->format('Y') }}</small> --}}
                                <small class="text-body-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-play-fill" viewBox="0 0 16 16">
                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393z"/>
                                    </svg>
                                    {{ $purchase->record->plays()->sum('count') }}
                                </small>
                            </div>
                        </a>
                        <div class="w-50 d-flex align-items-center">
                            <audio controls class="w-100">
                                <source src="{{ asset('storage/'.$purchase->record->link) }}" type="audio/mpeg">
                                Тег audio не поддерживается вашим браузером.
                            </audio>
                        </div>
                        <div class="d-flex flex-column align-items-center justify-content-between">
                            <small class="text-body-secondary">
                                Добавлен:
                                {{ $purchase->record->created_at->diffForHumans() }}
                            </small>
                            <a href="{{ route('user.purchase.download', $purchase) }}" class="btn btn-success btn-sm mx-1" role="button" aria-pressed="false">Скачать</a>
                        </div>
                    </div>
                </div>
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
