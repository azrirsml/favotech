<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use App\Models\CarType;
use App\Models\State;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cars = Car::query()
            ->with('carType', 'owner')
            ->when(auth()->user()->isOwner(), fn ($query) => $query->where('owner_id', auth()->id()))
            ->when($request->state_id, fn ($query) => $query->whereHas('owner', function ($owner) use ($request) {
                $owner->where('state_id', $request->state_id);
            }))
            ->when($request->car_type_id, fn ($query) => $query->where('car_type_id', $request->car_type_id))
            ->when($request->rent_price, fn ($query) => $query->where('rent_price', '<', $request->rent_price))
            ->when($request->available_date, fn ($query) => $query->whereDate('available_date', $request->available_date))
            ->get();

        return view('cars.index', [
            'cars' => $cars,
            'states' => State::all(),
            'carTypes' => CarType::all(),
        ]);
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

        return to_route('cars.index');
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
}
