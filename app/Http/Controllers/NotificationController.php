<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

     public function addNotification(Request $request)
{
    $user_id = $request->user()->id;

    Notification::create([
        'user_id' => $user_id,
        'is_read' => null,
        'message' => $request->message,
    ]);

            return redirect()->route('home');        
    
}

public function deleteNotification(Request $request)
{
    $notificationId = $request->id;
    $notification = Notification::find($notificationId);

    if ($notification) {
        $notification->delete();
    }

    return redirect()->route('home');

}


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}