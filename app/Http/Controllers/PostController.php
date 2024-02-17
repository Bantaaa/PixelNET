<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Likes;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
             $post->comments = Comment::where('id_post', $post->id)->with('user')->get();
             $post->user = $post->user->Fname;
             $existing_like = Likes::where('id_user', Auth::user()->id)->where('id_post', $post->id)->first();
             $likedPosts = session('alreadyliked', []);

        if ($existing_like) {
            $likedPosts[$post->id] = true;
        } else {
            $likedPosts[$post->id] = false;
        }
         }
     
         return view('home', compact('posts', 'likes_count'));
     }


    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('post.createPost');
    // }

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

        if($image = $request->file('image')){
            $destinationPath = 'images/';
            $profileImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath,$profileImage);
            $posts['image'] = "$profileImage";
            Post::create($posts);
            return redirect()->route('home');
        }else{
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
