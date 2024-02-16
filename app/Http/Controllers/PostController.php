<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Likes;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

        // $users = Comment::with('Post')->get();
        // dd($users);
    //     $posts = Post::join('comments', 'posts.id', '=', 'comments.id_post')
    // ->join('users', 'posts.id_user', '=', 'users.id')
    // ->select('posts.*', 'comments.content as comment_content', 'users.Fname', 'users.Lname')
    // ->get();
    //         dd($posts);

        $posts = Post::latest()->paginate(6);
        $likes_count = [];
        foreach ($posts as $post) {
            $likes_count[$post->id] = Likes::where('id_post', $post->id)->count();
        }
        return view('home', compact('posts', 'likes_count'));
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
        $user = Auth::user();
        $userName = $user->Fname . ' ' . $user->Lname;

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

    public function addLike(Request $request, string $id)
    {
        $posts = Post::findOrFail($id);
        $user_id = $request->user()->id;



        $existing_like = Likes::where('id_user', $user_id)->where('id_post', $id)->first();

        $likedPosts = session('alreadyliked', []);

        if ($existing_like) {
            $likedPosts[$id] = true;
        } else {
            $likedPosts[$id] = false;
        }


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

        echo "gg";




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
