<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Models\Folows;
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
     
    public function index(Request $request, int $id)
{
    $user = Auth::user();
    Session::put('receiver_id', $id);
    $sent_messages = Message::where('sender', Auth::user()->id)->where('receiver', $id)->get();
    $received_messages = Message::where('sender', $id)->where('receiver', Auth::user()->id)->get();

    $allMessages = $sent_messages->merge($received_messages);

    $followers = Folows::where('follower_id', Auth::user()->id)->get();
    $follower = Folows::where('user_id', $id)->first();

    return view('chat', compact('allMessages', 'received_messages', 'sent_messages', 'followers', 'follower'));
}
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $follws = Folows::all();

        return view('users' , compact("users" , "follws"));
    }
    public function pstman()
    {
        $users = User::all();
        $follws = Folows::all();
        

        return response()->json(
            ['user'=> $users,
            'follws'=>$follws
            ]
        ) ;
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
        // dd($request->user->id);
        Message::create([
            'sender' => $sender,
            'receiver' => Session::get('receiver_id'),
            'content' => $request->content
        ]);
        // dd(Session::get('receiver_id'));
        return redirect()->back();
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
