<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Artist;
use App\Models\Genre;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','can:moder,admin']);
    }

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
            'name' => 'required|string|min:2|max:255',
            'genre'  => 'required|array|exists:genres,id',
            'status' => ['required', 'string', Rule::in(array_keys(Artist::$statuses))],
        ]);

        $artist->name = $request->name;
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
