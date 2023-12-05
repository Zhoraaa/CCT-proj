<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function checkUser()
    {
        if (session('user')) {

        } else {
            return view('user.signPage');
        }
    }
    public function auth($userData)
    {
        $user = User::where('email', $userData->email)
        ->where('password', Hash::make($userData->password))
        ->first();

        dd($user);
    }
    public function signIn(Request $request)
    {

    }
    public function signUp(Request $userData)
    {
        $validate = $userData->validate([
            'login' => 'required|regex:/^[A-Za-z0-9_]{3,16}$/|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:32|confirmed|regex:/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_]).{6,32}$/',
            'pdata' => 'required'
        ]);

        $user = User::create([
            'login' => $userData->login,
            'email' => $userData->email,
            'password' => Hash::make($userData->password),
        ]);

        $this->auth($userData);

        return redirect(route('checkUser'));
    }

    public function signOut()
    {

    }

}
