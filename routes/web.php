<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::get('/' , [PostController::class , 'index'])->name("home");
Route::get('/register', [AuthController::class, 'auth'])->name('login');
Route::post('/register', [AuthController::class, 'signup'])->name('bilal');

Route::get('/login', [AuthController::class, 'auth'])->name('login');
Route::post('/login', [AuthController::class, 'signin'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/post' , [PostController::class , 'create'])->name('post');
Route::post('/post/create' , [PostController::class , 'store'])->name('create');
// test
Route::post('/register', [AuthController::class, 'signup'])->name('register');
Route::get('/login', [AuthController::class, 'auth'])->name('login');
Route::post('/login', [AuthController::class, 'signin'])->name('login');// Route::post('/custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

