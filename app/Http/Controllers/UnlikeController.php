<?php

namespace App\Http\Controllers;

use App\Models\Unlike;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnlikeController extends Controller
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
        return view('unlike.index', [
            'unlikes' => Auth::user()->unlikes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Record $record)
    {
        $user = Auth::user();

        $record->unlikes()->firstOrCreate([
            'user_id' => $user->id,
        ]);

        return redirect()->route('record.show', $record);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unlike  $unlike
     * @return \Illuminate\Http\Response
     */
    public function show(Unlike $unlike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unlike  $unlike
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unlike $unlike)
    {
        $unlike->delete();

        return redirect()->route('record.show', $unlike->unliked);
    }
}
