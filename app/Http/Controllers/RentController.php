<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function __invoke()
    {
        return view('rents.index', ['rents' => Rent::rentLists()]);
    }
}
