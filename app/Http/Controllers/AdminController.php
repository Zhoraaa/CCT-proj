<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function usrRedaction()
    {
        $users = User::join('roles', 'users.role', '=', 'roles.id')
            ->select('users.*', 'roles.name as role')
            ->paginate(10);

        // dd($data);
        

        return view('admin.allUsers', compact('users'));
    }

    public function doMod(Request $request)
    {
        User::where('id', $request->id)
        ->update([
            'role' => 2
        ]);
        return redirect()->back();
    }
    public function undoMod(Request $request)
    {
        User::where('id', $request->id)
        ->update([
            'role' => 3
        ]);
        return redirect()->back();
    }
    public function ban(Request $request)
    {
        User::where('id', $request->id)
        ->update([
            'banned' => 1
        ]);
        return redirect()->back();
    }
    public function unban(Request $request)
    {
        User::where('id', $request->id)
        ->update([
            'banned' => 0
        ]);
        return redirect()->back();
    }
}
