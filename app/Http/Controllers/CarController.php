<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use App\Models\CarType;
use App\Models\Rent;
use App\Notifications\CarRentalPayment;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cars.index', ['cars' => Car::carLists()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create', ['carTypes' => CarType::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $car = auth()->user()->cars()->create($request->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $car->addMedia($image)->toMediaCollection('car_images');
            }
        }

        return to_route('cars.index', ['cars' => Car::carLists()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('cars.show', ['car' => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('cars.edit', ['car' => $car, 'carTypes' => CarType::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->update($request->validated());

        if ($request->hasFile('images')) {
            $car->clearMediaCollection('car_images'); // remove old images

            foreach ($request->file('images') as $image) {
                $car->addMedia($image)->toMediaCollection('car_images');
            }
        }

        return to_route('cars.index', ['cars' => Car::carLists()]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }

    public function rent(Request $request, Car $car)
    {
        auth()->user()->rents()->create($request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'receipt' => ['required', 'exclude'],
        ]) + ['car_id' => $car->id]);

        if ($request->hasFile('receipt')) {
            $car->clearMediaCollection('receipts'); // remove old files
            $car->addMedia($request->receipt)->toMediaCollection('receipts');
        }

        //notify email ke owner
        $owner = $car->owner;

        if ($owner) {
            $owner->notify(new CarRentalPayment(auth()->user()));
        }

        return to_route('cars.index', ['cars' => Car::carLists()]);
    }
}
