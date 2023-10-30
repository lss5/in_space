<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Record;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('artist.index', [
            'artists' => Artist::active()->get(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        $this->authorize('view', $artist);

        $playlists = [];

        if (Auth::user()) {
            $playlists = Auth::user()->playlists;
        }

        return view('artist.show', [
            'artist' => $artist,
            'records' => $artist->records,
            'playlists' => $playlists,
        ]);
    }
}
