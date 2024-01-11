<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Record;

class PlaylistRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Playlist  $playlist
     * @param  App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Playlist $playlist, Record $record)
    {
        if ($request->user()->can('update', $playlist)){
            $playlist->records()->syncWithoutDetaching($record);

            return redirect()->route('user.playlist.show', $playlist);
        }
        return redirect()->back();
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Playlist  $playlist
     * @param  App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Playlist $playlist, Record $record)
    {
        if ($request->user()->can('update', $playlist)){
            $playlist->records()->detach($record);

            return redirect()->route('user.playlist.show', $playlist);
        }
        return redirect()->back();
    }
}
