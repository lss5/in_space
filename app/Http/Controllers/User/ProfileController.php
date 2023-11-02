<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Artist;
use App\Models\Record;
use App\Models\User;

class ProfileController extends Controller
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
        // All system capabilities
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $profile = Auth::user();

        return view('users.profile.edit', [
            'profile' => $profile,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $profile = Auth::user();

        return view('users.profile.index', [
            'profile' => $profile,
            'artists' => $profile
                ->artists()
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get(),
            'records' => $profile
                ->records()
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get(),
            'playlists' => $profile
                ->playlists()
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get(),
            'liked' => $profile
                ->likes()
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, User $user)
    {
        if(Auth::id() !== $user->id) {
            return redirect()->route('user.profile')->with('warning', 'Произошла ошибка. Перезагрузите страницу.');
        }

        if ($request->hasFile('image')) {
            // delete old images
            foreach ($user->images as $image) {
                $image->delete();
            }
            //create new image with link new image
            $user->images()->create([
                'link' => $request->file('image')->store('user/'.$user->id.'/images/avatar', 'public'),
            ]);
        }

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->description = $request->description;
        $user->save();

        return redirect()->route('user.profile.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Send request to remove
    }
}
