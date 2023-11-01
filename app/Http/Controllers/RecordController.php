<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Playlist;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('record.index', [
            'records' => Record::active()->orderBy('created_at', 'desc')->get(),
            'playlists' => $user ? $user->playlists : [],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        $user = Auth::user();
        $playlists = [];
        $like = null;
        $unlike = null;

        if ($user) {
            $play = $user->plays()->firstOrCreate([
                'record_id' => $record->id,
            ]);
            $play->increment('count');

            $playlists = $user->playlists;
            $like = $record->likes()->where('user_id', $user->id)->first();
            $unlike = $record->unlikes()->where('user_id', $user->id)->first();
        }

        return view('record.show', [
            'record' => $record,
            'playlists' => $playlists,
            'like' => $like,
            'unlike' => $unlike,
            'plays' => $record->plays()->sum('count'),
        ]);
    }

}
