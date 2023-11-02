<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Record;
use App\Models\Genre;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:moder,admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.record.index', [
            'records' => Record::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        return view('admin.record.edit', [
            'record' => $record,
            'genres' => Genre::all(),
            'statuses' => Record::$statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'genre'  => 'required|array|exists:genres,id',
            'status' => ['required', 'string', Rule::in(Record::$statuses)],
        ]);

        $record->name = $request->name;
        $record->status = $request->status;
        $record->save();
        $record->genres()->detach();
        $record->genres()->attach($request->genre);

        return redirect()->route('admin.record.index', $record);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        $record->delete();

        return redirect()->route('admin.record.index');
    }
}
