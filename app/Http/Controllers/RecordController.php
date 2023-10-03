<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use App\Models\Artist;
use App\Models\Record;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Record::class, 'record');
//        $this->middleware('log')->only('index');
//        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('record.index', [
            'user' => $user,
            'records' => $user->records()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('record.create', [
            'artists' => Artist::where('user_id', '=', Auth::user()->id)->get(),
        ]);
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
        $record->user()->associate(Auth::user()->id);
        $record->artist()->associate($request->artist);
        $record->save();

        if ($request->hasFile('image')) {
            $record->images()->create([
                'link' => $request->file('image')->store('user/'.$record->user_id.'/images/records', 'public'),
            ]);
        }

        return redirect()->route('artist.show', $request->artist);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        return view('record.show', [
            'record' => $record,
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
        return view('record.edit', [
            'record' => $record,
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
        $record->save();

        return redirect()->route('record.show', $record);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        foreach ($record->images as $image) {
            $image->delete();
        }
        $record->delete();

        return redirect()->route('artist.show', $record->artist);
    }
}
