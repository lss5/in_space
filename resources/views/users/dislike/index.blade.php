@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>Не понравились</h1>
            <hr class="py-1">

            <div class="list-group">
            @forelse($dislikes as $dislike)
                <a href="{{ route('record.show', $dislike->disliked) }}" class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <div class="d-flex flex-row align-items-center w-25">
                            <div class="me-3 d-flex flex-column align-items-center">
                            @if($dislike->disliked->images->count() > 0)
                                    <img src="{{ asset('storage/'.$dislike->disliked->latestImage->link) }}" alt="" class="img img-fluid">
                                @elseif($dislike->disliked->artist->images->count() > 0)
                                    <img src="{{ asset('storage/'.$dislike->disliked->artist->latestImage->link) }}" alt="" class="img img-fluid">
                                @else
                                    <img src="{{ asset('images/no_artist.png') }}" alt="" class="img img-fluid">
                            @endif
                            </div>
                            <div>
                                <h5 class="mb-1">{{ $dislike->disliked->name }}</h5>
                                <p class="mb-1">
                                    @isset($dislike->disliked->artist->name)
                                        {{ $dislike->disliked->artist->name }}
                                    @else
                                        Неизвестен
                                    @endisset
                                </p>
                                <small class="text-body-secondary">{{ $dislike->disliked->created_at->format('Y') }}</small>
                            </div>
                        </div>
                        <div class="w-50 d-flex align-items-center">
                            <audio controls class="w-100">
                                <source src="{{ asset('storage/'.$dislike->disliked->link) }}" type="audio/mpeg">
                                Тег audio не поддерживается вашим браузером.
                            </audio>
                        </div>
                        <small class="text-body-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
                                <path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.378 1.378 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51.136.02.285.037.443.051.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.896 1.896 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2.094 2.094 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.162 3.162 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.823 4.823 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591z"/>
                              </svg>
                            {{ $dislike->created_at->diffForHumans() }}
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
