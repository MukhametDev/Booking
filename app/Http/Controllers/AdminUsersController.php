<?php

namespace App\Http\Controllers;

use App\Events\RoleChanged;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class AdminUsersController extends Controller
{
    public function showAllUsers(){
        $users = User::all();
        return Inertia::render('Users',[
            'users'=>$users,
        ]);
    }

    public function updateRole(Request $request, User $user){
        $user->update(['role'=>$request->role]);
        event(new RoleChanged($user));
        return redirect()->back();
    }
}
