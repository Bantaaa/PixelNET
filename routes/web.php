<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FolowsController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/' , [PostController::class , 'index'])->name('home');
Route::get('/register', [AuthController::class, 'auth'])->name('login');
// Route::post('/register', [AuthController::class, 'signup'])->name('bilal');

Route::get('/login', [AuthController::class, 'auth'])->name('login');
Route::post('/login', [AuthController::class, 'signin'])->name('login');
Route::post('/register', [AuthController::class, 'signup'])->name('register');

// Route::post('/reg', [AuthController::class, 'sig'])->name('register');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/' , [PostController::class , 'store'])->name('create');
// Route::post('/post/create' , [PostController::class , 'store'])->name('create');
Route::post('/posts/{id}/like', [LikeController::class, 'addLike'])->name('post.like');
Route::post('/posts/{id}/comment', [CommentController::class, 'addComment'])->name('post.comment');
Route::get('notifications/delete/{id}', [NotificationController::class, 'deleteNotification'])->name('deleteNotification');

// Route::get('/message/{id}', [MessageController::class, 'store'])->name("index");
Route::post('/sendMessage', [MessageController::class, 'store'])->name('store');

Route::get('/message/{id}', [MessageController::class, 'index'])->name('index1');

Route::get('/user', [MessageController::class, 'create']);

Route::get('/pstman', [MessageController::class, 'pstman']);

Route::delete('folows/{id}/unfollow', [FolowsController::class, 'destroy'])->name('unfollow');

Route::post('/folows/{id}/follow', [FolowsController::class, 'store'])->name('follow');
Route::post('/follows/{id}/follow', [FolowsController::class, 'addUser'])->name('user_follow');


Route::get('/follow', [FolowsController::class, 'follow'])->name('foll');

Route::get('/supremerProfile' , [AuthController::class , 'supremerProfile']);


// messages
Route::get('chat/{id}', [MessageController::class, 'index'])->name('chat');
Route::post('/msg', [MessageController::class, 'store'])->name('msg');

