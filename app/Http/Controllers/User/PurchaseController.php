<?php

namespace App\Http\Controllers\User;

use App\Models\Purchase;
use App\Models\Record;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PurchaseController extends Controller
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
        return view('users.purchase.index', [
            'purchases' => Auth::user()->purchased,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function create(Record $record)
    {
        // if record was pay
        if ($record->purchasers()->forUser(Auth::user())->first()) {
            return redirect()->route('record.show', $record)->with('warning', 'Запись "'.$record->artist->name.' - '.$record->name.'" уже куплена.');
        }

        return view('users.purchase.create', [
            'record' => $record,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'record'  => 'required|integer|exists:records,id',
        ]);

        $record = Record::findOrFail($request->record);

        Auth::user()->purchased()->firstOrCreate([
            'record_id' => $record->id,
        ]);

        return redirect()->route('record.show', $record)->with('success', 'Покупка записи "'.$record->artist->name.' - '.$record->name.'" успешно оплачена.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function download(Purchase $purchase)
    {
        // add purchase policy
        if ($purchase->user_id === Auth::id()) {
            return Storage::download($purchase->record->link, $purchase->record->artist->name.' - '.$purchase->record->name.'.'.$purchase->record->extension);
        }

        return view('record.show', $purchase->record);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        if ($purchase->user_id === Auth::id()) {
            return view('users.purchase.show', [
                'purchase' => $purchase,
                'playlists' => Auth::user()->playlists,
            ]);
        }

        return redirect()->route('user.profile.show')->with('warning', 'Произошла ошибка. Перезагрузите страницу.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }
}
