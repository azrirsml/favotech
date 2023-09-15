<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rent;
use App\Notifications\CarRentalPayment;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function index()
    {
        $ownerCarIds = auth()->user()->cars()->pluck('id')->toArray();

        $rents = Rent::query()
            ->with('car', 'car.owner', 'tenant')
            ->when(auth()->user()->isOwner(), fn ($query) => $query->whereIn('car_id', $ownerCarIds))
            ->when(auth()->user()->isTenant(), fn ($query) => $query->where('tenant_id', auth()->id()))
            ->get();

        return view('rents.index', ['rents' => $rents]);
    }

    public function store(Request $request, Car $car)
    {
        $rent = auth()->user()->rents()->create($request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'receipt' => ['required', 'exclude'],
        ]) + ['car_id' => $car->id]);

        if ($request->hasFile('receipt')) {
            $rent->clearMediaCollection('receipts'); // remove old files
            $rent->addMedia($request->receipt)->toMediaCollection('receipts');
        }

        //notify email ke owner
        $owner = $car->owner;

        if ($owner) {
            $owner->notify(new CarRentalPayment(auth()->user()));
        }

        return to_route('rents.index');
    }
}
