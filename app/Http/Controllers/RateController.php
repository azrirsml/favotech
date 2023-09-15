<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function create()
    {
        return view('rates.create');
    }

    public function store(Request $request)
    {
        Rating::create($request->validate([
            'comment' => 'required',
            'rate' => 'required',
            'car_id' => 'required',
        ]));

        return to_route('rents.index');
    }
}
