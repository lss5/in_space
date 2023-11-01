<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Record;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Artist::class, 'artist');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('user.artist.index', [
            'user' => $user,
            'artists' => $user->artists,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.artist.create', [
            'genres' => Genre::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreArtistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArtistRequest $request)
    {
        $artist = new Artist();
        $artist->name = $request->name;
        $artist->description = $request->description;
        $artist->user_id = Auth::user()->id;
        $artist->save();

        $artist->genres()->attach($request->genre);

        if ($request->hasFile('image')) {
            $artist->images()->create([
                'link' => $request->file('image')->store('user/'.$artist->user_id.'/images/artists', 'public'),
            ]);
        }

        return redirect()->route('user.artist.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        $playlists = [];

        if (Auth::user()) {
            $playlists = Auth::user()->playlists;
        }

        return view('user.artist.show', [
            'artist' => $artist,
            'records' => $artist->records,
            'playlists' => $playlists,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        return view('user.artist.edit', [
            'artist' => $artist,
            'genres' => Genre::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateArtistRequest  $request
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateArtistRequest $request, Artist $artist)
    {
        if ($request->hasFile('image')) {
            // delete old images
            foreach ($artist->images as $image) {
                $image->delete();
            }
            //create new image with link new image
            $artist->images()->create([
                'link' => $request->file('image')->store('user/'.$artist->user_id.'/images/artists', 'public'),
            ]);
        }

        $artist->name = $request->name;
        $artist->description = $request->description;
        $artist->save();

        $artist->genres()->detach();
        $artist->genres()->attach($request->genre);

        return redirect()->route('user.artist.show', $artist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('user.artist.index');
    }
}
