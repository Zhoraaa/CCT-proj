<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function usrRedaction() {
        $users = User::join('roles', 'users.role', '=', 'roles.id')
        ->select('users.*', 'roles.name as role')
        ->paginate(10);

        // dd($users);

        return view('admin.allUsers', compact('users'));
    }
}
