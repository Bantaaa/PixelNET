<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public $sen ;
     
    public function index(Request $request)
    {
        $sender_id = $request->id;
        $receiver_id = Auth::id();
        $this->sen = $sender_id;
        Session::put('receiver_id', $request->id);
        $sent_messages = Message::where('sender', $sender_id)->where('receiver', $receiver_id)->get();
        $received_messages = Message::where('sender', $receiver_id)->where('receiver', $sender_id)->get();
    
        $messages = $sent_messages->merge($received_messages);

        return view('message', compact('messages'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();

        return view('users' , compact("users"));
    }

    public function message()
    {
        $users = User::all();

        return view('users' , compact("users"));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $sender = $user->id;
        Message::create([
            'sender' => $sender,
            'receiver' => Session::get('receiver_id'),
            'content' => $request->content
        ]);
        return redirect('/message/'.Session::get('receiver_id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
