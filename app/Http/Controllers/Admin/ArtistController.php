<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Artist;
use App\Models\Genre;

class ArtistController extends Controller
{
    public function index()
    {
        return view('admin.artist.index', [
            'artists' => Artist::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    public function edit(Artist $artist)
    {
        return view('admin.artist.edit', [
            'artist' => $artist,
            'genres' => Genre::all(),
            'statuses' => Artist::$statuses,
        ]);
    }

    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => 'required|string|min:4|max:255',
            'description' => 'nullable|string|max:61440',
            'genre'  => 'required|integer|exists:genres,id',
            'status' => ['required', 'string', Rule::in(Artist::$statuses)],
        ]);

        $artist->name = $request->name;
        $artist->description = $request->description;
        $artist->status = $request->status;
        $artist->save();

        $artist->genres()->detach();
        $artist->genres()->attach($request->genre);

        return redirect()->route('admin.artist.index');
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('admin.artist.index');
    }
}
