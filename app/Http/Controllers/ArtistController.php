<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use App\Models\Artist;
use App\Models\Record;
use Illuminate\Support\Facades\Auth;

class ArtistController extends Controller
{
    public function __construct()
    {
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

        return view('artist.index', [
            'user' => $user,
//            'artists' => $user->artists()->get(),
            'artists' => Artist::with(['user', 'records'])->where('user_id', '=', $user->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artist.create');
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
        $artist->user_id = Auth::user()->id;
        $artist->save();

        if ($request->hasFile('image')) {
            $artist->images()->create([
                'link' => $request->file('image')->store('user/'.$artist->user_id.'/images/artists', 'public'),
            ]);
        }

        return redirect()->route('artist.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        return view('artist.show', [
            'artist' => $artist,
            'records' => $artist->records()->get(),
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
        return view('artist.edit', [
            'artist' => $artist,
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
        $artist->save();

        return redirect()->route('artist.show', $artist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        // TODO: Deleting relations Records
        foreach ($artist->images as $image) {
            $image->delete();
        }

        $artist->delete();

        return redirect()->route('artist.index');
    }
}