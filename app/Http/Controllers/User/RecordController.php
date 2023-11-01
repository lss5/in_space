<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use App\Http\Controllers\Controller;
use App\Models\Record;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Playlist;


class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Record::class, 'record');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('user.record.index', [
            'user' => $user,
            'records' => $user->records()->orderBy('created_at', 'desc')->get(),
            'playlists' => $user->playlists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $artists = Auth::user()->artists()->active()->get();

        if ($artists->count() > 0) {
            return view('user.record.create', [
                'artists' => $artists,
                'genres' => Genre::all(),
            ]);
        } else {
            return redirect()->route('user.artist.index')->with('warning', 'Для создания записи необходимо добавить Артиста');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecordRequest $request)
    {
        $record = new Record();
        $record->name = $request->name;
        $record->description = $request->description;
        $record->link = $request->file('audio')->store('user/'.$record->user_id.'/audio/', 'public');
        $record->user()->associate(Auth::user());
        $record->artist()->associate($request->artist);
        $record->save();

        $record->genres()->attach($request->genre);

        if ($request->hasFile('image')) {
            $record->images()->create([
                'link' => $request->file('image')->store('user/'.$record->user_id.'/images/records', 'public'),
            ]);
        }

        return redirect()->route('user.record.show', $record);
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

        return view('user.record.show', [
            'record' => $record,
            'playlists' => $playlists,
            'like' => $like,
            'unlike' => $unlike,
            'plays' => $record->plays()->sum('count'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        return view('user.record.edit', [
            'record' => $record,
            'genres' => Genre::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecordRequest  $request
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecordRequest $request, Record $record)
    {
        if ($request->hasFile('image')) {
            // delete old images
            foreach ($record->images as $image) {
                $image->delete();
            }
            //create new image with link new image
            $record->images()->create([
                'link' => $request->file('image')->store('user/'.$record->user_id.'/images/records', 'public'),
            ]);
        }

        $record->name = $request->name;
        $record->description = $request->description;
        $record->save();
        $record->genres()->detach();
        $record->genres()->attach($request->genre);

        return redirect()->route('user.record.show', $record);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        // Delete all images
        foreach ($record->images as $image) {
            $image->delete();
        }
        // Delete records from playlists
        $record->playlists()->detach();

        $record->delete();

        return redirect()->route('user.record.index');
    }

    public function to_playlist(Request $request, Record $record, Playlist $playlist)
    {
        // TODO: add validates
        if ($request->user()->can('update', $playlist)){
            $playlist->records()->syncWithoutDetaching($record);

            return redirect()->route('playlist.show', $playlist);
        }
        return abort(404);
    }

    public function out_playlist(Request $request, Record $record, Playlist $playlist)
    {
        // TODO: add validates
        if ($request->user()->can('update', $playlist)){
            $playlist->records()->detach($record);

            return redirect()->route('playlist.show', $playlist);
        }
        return abort(404);
    }
}
