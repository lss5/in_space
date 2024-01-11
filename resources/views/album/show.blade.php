@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="d-flex flex-row">
                <div class="w-25 me-3">
                    @if($album->images()->count() > 0)
                        <img src="{{ asset('storage/'.$album->latestImage->link) }}" alt="" class="img img-thumbnail img-fluid" style="width: 200px">
                    @else
                        <img src="{{ asset('images/no_artist.png') }}" alt="" class="img img-thumbnail img-fluid">
                    @endif
                </div>
                <div class="d-flex flex-column justify-content-between">
                    <h1 class="h4">Альбом: {{ $album->title }}</h1>
                    <span>
                        @foreach ($album->artists as $artist)
                            <a href="{{ route('artist.show', $artist) }}">{{ $artist->name }}</a>
                        @endforeach
                    </span>
                </div>
            </div>
        <hr class="py-1">
            <div class="list-group">
                @foreach($album->records as $record)
                    @include('partial.record_list_item')
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
