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
     * Display a listing Record type of Audio.
     *
     * @return \Illuminate\Http\Response
     */
    public function music()
    {
        $user = Auth::user();

        return view('record.audio.index', [
            'records' => Record::audio()->public()->active()->orderBy('created_at', 'desc')->get(),
            'playlists' => $user ? $user->playlists : [],
        ]);
    }

    /**
     * Display a listing Record type of video.
     *
     * @return \Illuminate\Http\Response
     */
    public function video()
    {
        $user = Auth::user();

        return view('record.video.index', [
            'records' => Record::video()->public()->active()->orderBy('created_at', 'desc')->get(),
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
        $dislike = null;

        if ($user) {
            $play = $user->plays()->firstOrCreate([
                'record_id' => $record->id,
            ]);
            $play->increment('count');

            $playlists = $user->playlists;
            $like = $record->likes()->where('user_id', $user->id)->first();
            $dislike = $record->dislikes()->where('user_id', $user->id)->first();
        }

        return view('record.show', [
            'record' => $record,
            'playlists' => $playlists,
            'like' => $like,
            'dislike' => $dislike,
            'plays' => $record->plays()->sum('count'),
        ]);
    }

}
