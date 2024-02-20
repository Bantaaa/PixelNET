<?php

namespace App\Http\Controllers;

use App\Models\Folows;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolowsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function follow()
    {
        $id = Auth::id();
        $follows = Folows::where('user_id', $id)->with('user')->get();

        return view('folow' , compact('follows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $followed = Folows::where('user_id', auth()->id())
            ->where('follower_id', $request->follower_id)
            ->first();


        if (!$followed) {
            $follower = new Folows();
            $follower->user_id = auth()->id();
            $follower->follower_id = $request->follower_id;
            $follower->save();
            return redirect('/user');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Folows $folows)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Folows $folows)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Folows $folows)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Folows::where('user_id', auth()->id())
            ->where('follower_id', $request->id)
            ->delete();



        return redirect('/user');
    }
}
