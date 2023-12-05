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

Route::get('/post', [PostController::class, "postEditor"])->name('postNew');
Route::get('/forum', [PostController::class, "allPosts"])->name('forum');
Route::get('/post/{id}', [PostController::class, "seePost"])->name('seePost');
Route::post('/post/save', [PostController::class, "postSave"])->name('savePost');

Route::get('/user', [UserController::class, "checkUser"])->name("checkUser");
Route::post('/user/new', [UserController::class, "signUp"])->name("signUp");