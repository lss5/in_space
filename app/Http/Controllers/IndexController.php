<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Record;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Playlist;

class IndexController extends Controller
{
    public function index()
    {
        $playlists = [];
        if (Auth::user()) {
            $playlists = Auth::user()->playlists;
        }
        return view('index', [
            'records' => Record::orderBy('created_at', 'desc')->limit(10)->get(),
            'artists' => Artist::orderBy('created_at', 'desc')->limit(4)->get(),
            'genres' => Genre::all(),
            'playlists' => $playlists,
        ]);
    }
}
