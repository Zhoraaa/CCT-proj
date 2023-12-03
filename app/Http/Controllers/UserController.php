<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function checkUser() {
        if (session('user')) {

        } else {
            return view('user.signPage');
        }
    }
    public function signIn() {

    }
    public function signUp() {

    }
    public function signOut() {

    }

}
