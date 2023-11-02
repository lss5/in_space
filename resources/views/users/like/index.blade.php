@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>Понравившиеся</h1>
            <hr class="py-1">

            <div class="list-group">
            @forelse($likes as $like)
                <a href="{{ route('record.show', $like->liked) }}" class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <div class="d-flex flex-row align-items-center w-25">
                            <div class="me-3 d-flex flex-column align-items-center">
                            @if($like->liked->images->count() > 0)
                                    <img src="{{ asset('storage/'.$like->liked->latestImage->link) }}" alt="" class="img img-fluid">
                                @elseif($like->liked->artist->images->count() > 0)
                                    <img src="{{ asset('storage/'.$like->liked->artist->latestImage->link) }}" alt="" class="img img-fluid">
                                @else
                                    <img src="{{ asset('images/no_artist.png') }}" alt="" class="img img-fluid">
                            @endif
                            </div>
                            <div>
                                <h5 class="mb-1">{{ $like->liked->name }}</h5>
                                <p class="mb-1">
                                    @isset($like->liked->artist->name)
                                        {{ $like->liked->artist->name }}
                                    @else
                                        Неизвестен
                                    @endisset
                                </p>
                                <small class="text-body-secondary">{{ $like->liked->created_at->format('Y') }}</small>
                            </div>
                        </div>
                        <div class="w-50 d-flex align-items-center">
                            <audio controls class="w-100">
                                <source src="{{ asset('storage/'.$like->liked->link) }}" type="audio/mpeg">
                                Тег audio не поддерживается вашим браузером.
                            </audio>
                        </div>
                        <small class="text-body-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                              </svg>
                            {{ $like->created_at->diffForHumans() }}
                        </small>
                    </div>
                </a>
            @empty
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Нет добавленых записей</h5>
                    <small class="text-body-secondary text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                        </svg>
                    </small>
                </div>
            @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
