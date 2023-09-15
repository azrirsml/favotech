<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', ['users' => User::all()]);
    }

    public function banned(User $user)
    {
        $user->status = 'banned';
        $user->save();

        return back();
    }

    public function unbanned(User $user)
    {
        $user->status = 'active';
        $user->save();

        return back();
    }
}
