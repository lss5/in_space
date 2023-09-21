@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row bg-white py-5">
        <div class="col-12 col-lg-8 mx-auto">
            <h1 class="h4 my-2">{{ $artist->name }}</h1>
            <hr class="py-1">
            <a href="{{ route('artist.index') }}" class="btn btn-light">{{ __('artist.btn_to_list') }}</a>
            <a type="button" class="btn btn-outline-danger"
                    onclick="event.preventDefault();
                    document.getElementById('delete_form').submit();">
                {{ __('artist.btn_delete') }}
            </a>
            <form id="delete_form" action="{{ route('artist.destroy', $artist) }}" method="POST" class="d-none">
                @method('DELETE')
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
