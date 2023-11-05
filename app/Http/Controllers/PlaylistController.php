<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('playlist.index', [
            'playlists' => Playlist::where('publicity', 'public')->get(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function show(Playlist $playlist)
    {
        if ($playlist->publicity == 'public') {
            return view('playlist.show', [
                'playlist' => $playlist,
            ]);
        }
    }
}
