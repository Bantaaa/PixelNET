<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Likes;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Folows;
use App\Models\Message;
use Illuminate\Support\Facades\Session;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $user = Auth::user();
        $posts = Post::latest()->paginate(6);
        $likes_count = [];
        $existing_like = [];
        $followed = [];
        $sent_messages = [];
        $received_messages = [];
        $users = User::all();
        if ($user) {
            $messages = Message::where('sender', $user->id)
                ->orWhere('receiver', $user->id)
                ->get();
        }


        foreach ($posts as $post) {
            $likes_count[$post->id] = Likes::where('id_post', $post->id)->count();
            if ($user) {
                $existing_like[$post->id] = Likes::where('id_post', $post->id)->where('id_user', $user->id)->first();
                $followed[$post->id] = Folows::where('user_id', $post->id_user)
                    ->where('follower_id', $user->id)
                    ->first();
            }

            $post->comments = Comment::where('id_post', $post->id)
                ->with('user')
                ->get();
            $post->user = $post->user->Fname;
        }

        if ($user) {
            $sender_id = Auth::id();
            Session::get('receiver_id', 0);
            $receiver_id = Auth::id();
            $request->session()->put('receiver_id', $receiver_id);

            $notifications = Notification::where('user_id', $user->id)->get();
            $followers = Folows::where('follower_id', $user->id)->get();

            foreach ($messages as $message) {
                if ($message->sender == $sender_id && $message->receiver == $receiver_id) {
                    $sent_messages[] = $message;
                }
                if ($message->sender == $receiver_id && $message->receiver == $sender_id) {
                    $received_messages[] = $message;
                }
            }
            //  dd($messages);

            return view('home', compact(
                'posts',

                'likes_count',
                'existing_like',
                'notifications',
                'followers',
                'followed',
                'users',
            ));
        } else {
            return view('home', compact('posts', 'likes_count'));
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.createPost');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'titer' => 'required|string',
        //     'content' => 'required|string',
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $posts = $request->all();
        // Post::create([
        //     'titer' => $request->titer,
        //     'content' => $request->content,
        //     'id_user'=> session('user_id'),
        //     'image'=>$request->image,
        // ]);
        $posts['id_user'] = session('user_id');

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $posts['image'] = "$profileImage";
            Post::create($posts);
            return redirect()->route('home');
        } else {
            $posts['image'] = "null";
            Post::create($posts);
            return redirect()->route('home');
        }
    }




    // public function addLike(Request $request, string $id)
    // {
    //     $post = Post::findOrFail($id);
    //     $likes = json_decode($post->like, true) ?? [];



    //     if (!in_array($request->user()->id, array_column($likes, 'id'))) {
    //         $likes[] = ['id' => $request->user()->id];
    //         $post->like = json_encode($likes);
    //         $post->save();
    //     } else {
    //         $key = array_search(4, array_column($likes, 'id'));
    //         unset($likes[$key]);
    //         $post->like = json_encode($likes);
    //         $post->save();
    //     }

    //     return redirect()->route('home');
    // }








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
