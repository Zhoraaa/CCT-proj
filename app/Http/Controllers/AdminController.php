<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function usrRedaction() {
        $data['users'] = User::join('roles', 'users.role', '=', 'roles.id')
        ->select('users.*', 'roles.name as role')
        ->paginate(10);

        $data['roles'] = DB::table('roles')
        ->where('id', '<', 1)
        ->get();

        dd($data);
        

        return view('admin.allUsers', compact('data'));
    }
}
