<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ChangeUserStatusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        $user->status = $user->status == 'active'
            ? 'banned'
            : 'active';

        $user->save();

        return back();
    }
}
