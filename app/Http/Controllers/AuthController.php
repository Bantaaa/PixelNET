<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Folows;
use App\Models\Likes;
use App\Models\Message;
use App\Models\Post;
use App\Models\User;
use App\Models\Reservation;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function auth()
    {

        return view("auth");
    }
    public function signup(Request $request)
    {
        $validatedData = $request->validate([
            'Fname' => 'required|string|max:255',
            'Lname' => 'required|string|max:255',
            'phone' => 'required|string|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ], [
            'Fname.required' => 'The first name field is required.',
            'Lname.required' => 'The last name field is required.',
            'phone.required' => 'The phone number field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
        ]);

        $user = $request->all();
        $user['password'] = Hash::make($request->password);

        User::create($user);

        return redirect()->route('login')->with('success', 'Account created successfully');
    }

    public function sig(Request $request)
    {
        $validatedData = $request->validate([
            'Fname' => 'required|string|max:255',
            'Lname' => 'required|string|max:255',
            'phone' => 'required|string|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        $user = $request->all();
        $user['password'] = Hash::make($request->password);

        User::create($user);
        return response()->json($user);
    }
    public function signin(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Authentication successful
            // session()->put('role', $user->role);
            session()->put([
                // 'role' => $user->role,
                'Fname' => $user->Fname,
                'user_id' => $user->id,
                'username' => $user->Fname . ' ' . $user->Lname,
            ]);
            // dd(session('role'));
            return redirect()->route('home'); // Redirect to the intended page or your dashboard
        } else {
            // Authentication failed
            return redirect()->route('register');
        }
    }

    // public function showSearch() {
    //     return view('posts.search');
    // }

    public function searchUsers(Request $request)
    {
        $keyword = $request->input('title_s');

        if ($keyword === '') {
            // If the search keyword is empty, return all users or handle as needed
            $users = User::all();
        } else {
            // Search for users with names containing the keyword
            $users = User::where('Fname', 'like', '%' . $keyword . '%')->get();
        }

        // dd($users);

        // Pass the users data to the view
        return response()->json($users);
    }

    public function supremerProfile(Request $request)
{
    $id = Auth::id();
    
    $user = User::find($id);
    $user->Fname = 'Pixel'; 
    $user->Lname = 'User'; 
    $user->save();

    // Rest of the code to delete related records and perform other actions...

    session()->flush();
    return redirect()->route('login');
}

    public function logout()
    {
        Auth::logout();
        session()->flush();

        return redirect()->route('login'); // Redirect to your logout route after logout
    }
}
