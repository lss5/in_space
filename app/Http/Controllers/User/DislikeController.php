<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Dislike;
use App\Models\Record;

class DislikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.dislike.index', [
            'dislikes' => Auth::user()->dislikes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Record $record)
    {
        $record->likes()->forUser(Auth::user())->delete();

        $record->dislikes()->firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        // return redirect()->route('record.show', $record);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dislike  $dislike
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dislike $dislike)
    {
        $dislike->delete();
        return redirect()->back();
    }
}
