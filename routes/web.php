<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/post', [PostController::class, "postEditor"])->middleware('auth')->name('postNew');
Route::get('/forum', [PostController::class, "allPosts"])->name('forum');
Route::get('/post/{id}', [PostController::class, "seePost"])->name('seePost');
Route::post('/post/{id}/edit', [PostController::class, "postEdit"])->name('postEdit');
Route::post('/post/{id}/delete', [PostController::class, "postDelete"])->name('postDelete');
Route::post('/post/save', [PostController::class, "postSave"])->middleware('auth')->name('savePost');

Route::get('/user', function () { return view('user.perArea'); })->name("user");
Route::get('/user/auth', function () { return view('user.authPage'); })->middleware('guest')->name("auth");
Route::get('/user/reg', function () { return view('user.regPage'); })->middleware('guest')->name("reg");
Route::post('/user/exit', [UserController::class, "logOut"])->middleware('auth')->name("logout");
Route::post('/user/new', [UserController::class, "signUp"])->name("signUp");
Route::post('/user/auth', [UserController::class, "signIn"])->name("signIn");
//test