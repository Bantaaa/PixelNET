<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function addComment(Request $request, string $id)
    {
        $user_id = $request->user()->id;
        $posts = Post::findOrFail($id);

        if ($posts) {
            Comment::create([
                'id_user' => $user_id,
                'id_post' => $id,
                'content' => $request->content
            ]);
            return redirect()->route('home')->with('success', 'Post liked successfully');
        }




        // if (!in_array($request->user()->id, array_column($likes, 'id'))) {
        //     $likes[] = ['id' => $request->user()->id , 'commente' => $request->commente];
        //     $post->like = json_encode($likes);
        //     $post->save();
        // } else {
        //     $key = array_search(4, array_column($likes, 'id'));
        //     unset($likes[$key]);
        //     $post->like = json_encode($likes);
        //     $post->save();
        // }


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
