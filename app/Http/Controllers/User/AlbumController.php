<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Album::class, 'album');
    }

    public function index()
    {
        $user = Auth()->user();

        return view('users.album.index', [
            'user' => $user,
            'albums' => $user->albums,
        ]);
    }

    public function create()
    {
        $user = Auth()->user();

        return view('users.album.create', [
            'artists' => $user->artists,
            'records' => $user->records,
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:2|max:255',
            'year'  => 'required|integer|min:1920|max:2030',
            'artists'  => 'required|array|exists:artists,id',
            'records'  => 'required|array|exists:records,id',
        ]);

        $album = new Album();
        $album->title = $request->title;
        $album->year = $request->year;
        $album->user_id = Auth::user()->id;
        $album->save();

        $album->artists()->attach($request->artists);
        $album->records()->attach($request->records);

        if ($request->hasFile('image')) {
            $album->images()->create([
                'link' => $request->file('image')->store('user/'.$album->user_id.'/images/albums', 'public'),
            ]);
        }

        return redirect()->route('user.album.show', $album);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        return view('users.album.show', [
            'album' => $album,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        $user = Auth()->user();

        return view('users.album.edit', [
            'album' => $album,
            'artists' => $user->artists,
            'records' => $user->records,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $request->validate([
            'title' => 'required|string|min:2|max:255',
            'year'  => 'required|integer|min:1920|max:2030',
            'artists'  => 'required|array|exists:artists,id',
            'records'  => 'required|array|exists:records,id',
        ]);

        $album->title = $request->title;
        $album->year = $request->year;
        $album->save();

        $album->artists()->sync($request->artists);
        $album->records()->sync($request->records);

        if ($request->hasFile('image')) {
            // delete old images
            foreach ($album->images as $image) {
                $image->delete();
            }
            //create new image with link new image
            $album->images()->create([
                'link' => $request->file('image')->store('user/'.$album->user->id.'/images/albums', 'public'),
            ]);
        }

        return redirect()->route('user.album.show', $album);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->route('user.album.index');
    }
}
