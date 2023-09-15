<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function __invoke()
    {
        $ownerCarIds = auth()->user()->cars()->pluck('id')->toArray();

        $rents = Rent::query()
            ->with('car', 'car.owner', 'tenant')
            ->when(auth()->user()->isOwner(), fn ($query) => $query->whereIn('car_id', $ownerCarIds))
            ->when(auth()->user()->isTenant(), fn ($query) => $query->where('tenant_id', auth()->id()))
            ->get();

        return view('rents.index', ['rents' => $rents]);
    }
}
