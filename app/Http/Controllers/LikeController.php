<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Likes;
use App\Models\Post;

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
        $posts = Post::findOrFail($id);
        $user_id = $request->user()->id;

        

        $existing_like = Likes::where('id_user', $user_id)->where('id_post', $id)->first();

        $likedPosts = session('alreadyliked', []);

        // if ($existing_like) {
        //     $likedPosts[$id] = true;
        // } else {
        //     $likedPosts[$id] = false;
        // }

        
        session()->put('alreadyliked', $likedPosts);
        
        // dd($existing_like);
        if ($posts) {
            if (!$existing_like) {
                Likes::create([
                    'id_user' => $user_id,
                    'id_post' => $id,
                ]);
                

                return redirect()->route('home')->with('success', 'Post liked successfully');
            } else {
                // Redirection si l'utilisateur a déjà aimé ce post
                
                return redirect()->route('home')->with('error', 'You have already liked this post');
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
