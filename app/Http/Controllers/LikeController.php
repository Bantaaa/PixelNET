<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Likes;
use App\Models\Post;
use App\Models\Notification;
use App\Http\Controllers\NotificationController;





class LikeController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    public function addLike(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $user = $request->user();

        $existing_like = Likes::where('id_user', $user->id)->where('id_post', $id)->first();

        if ($post) {
            if (!$existing_like) {
                Likes::create([
                    'id_user' => $user->id,
                    'id_post' => $id,
                ]);

                // Create a notification for the post owner
                Notification::create([
                    'user_id' => $post->id_user,
                    'message' => $user->Fname . ' ' . 'has liked your post',
                ]);

                return redirect()->route('home')->with('success', 'Post liked successfully');
            } else {
                // unlike
                $existing_like->delete();

                return redirect()->route('home')->with('success', 'Post unliked successfully');
            }
        }
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
