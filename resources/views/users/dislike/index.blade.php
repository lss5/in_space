@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1>Не понравились</h1>
        <hr class="py-1">
            <div class="list-group">
            @forelse($dislikes as $dislike)
                @php $record = $dislike->disliked; @endphp
                @include('partial.record_list_item')
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
