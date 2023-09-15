<x-app-layout>
    <x-card title="Manage Cars">
        @role('owner')
            <x-slot:button href="{{ route('cars.create') }}">
                Add Car
            </x-slot:button>
        @endrole

        <form action="/cars">
            <div class="row mb-3">
                <div class="col-3">
                    <label>State</label>
                    <select class="form-select mt-1" name="state_id">
                        <option value="">Select State</option>
                        @foreach ($states as $state)
                            <option value="{{ $state->id }}" @selected(request()->state_id == $state->id)>{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label>Car Type</label>
                    <select class="form-select mt-1" name="car_type_id">
                        <option value="">Select Type</option>
                        @foreach ($carTypes as $carType)
                            <option value="{{ $carType->id }}" @selected(request()->car_type_id == $carType->id)>{{ $carType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <label>Price (Less Than)</label>
                    <input class="form-control mt-1" name="rent_price" type="number" value="{{ request()->rent_price }}" min="0" />
                </div>
                <div class="col-3">
                    <label>Available Date</label>
                    <input class="form-control mt-1" name="available_date" type="date" value="{{ date('Y-m-d', strtotime(request()->available_date)) }}" />
                </div>

            </div>
            <button class="btn btn-sm btn-primary mb-10">Filter</button>
        </form>

        <x-table>
            <x-slot:header>
                <th>ID</th>
                <th>Car Name</th>
                <th>Owner</th>
                <th>Status</th>
                <th>Price</th>
                <th>Status</th>
                <th>Rules</th>
                <th>Description</th>
                <th>Available Date</th>
                <th></th>
            </x-slot:header>

            @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ "{$car->name} ({$car->carType?->name})" }}</td>
                    <td>{{ $car->owner?->name }}</td>
                    <td>{{ $car->status }}</td>
                    <td>RM {{ $car->rent_price }} (Promo: {{ $car->promo_price ?? 'No Promo' }}) </td>
                    <td>{{ $car->status }}</td>
                    <td>{{ $car->rules }}</td>
                    <td>{{ $car->description }}</td>
                    <td>{{ $car->available_date }}</td>
                    <td>
                        <div class="btn btn-group">
                            @role('owner')
                                <a class="btn btn-primary btn-sm" href="{{ route('cars.edit', $car) }}">Edit</a>
                            @else
                                <a class="btn btn-primary btn-sm" href="{{ route('cars.show', $car) }}">Rent</a>
                            @endrole
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-table>
    </x-card>
</x-app-layout>
