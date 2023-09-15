<x-app-layout>
    <x-card title="Manage Cars">
        @role('owner')
            <x-slot:button href="{{ route('cars.create') }}">
                Add Car
            </x-slot:button>
        @endrole

        <form action="/cars">
            <div class="row">
                <div class="col-4">State</div>
                <select class="" name="state_id"></select>

            </div>
        </form>

        <x-table>
            <x-slot:header>
                <th>ID</th>
                <th>Car Name</th>
                <th>Status</th>
                <th>Price</th>
                <th>Status</th>
                <th>Rules</th>
                <th>Description</th>
                <th></th>
            </x-slot:header>

            @foreach ($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ "{$car->name} ({$car->carType?->name})" }}</td>
                    <td>{{ $car->status }}</td>
                    <td>RM {{ $car->rent_price }} (Promo: {{ $car->promo_price ?? 'No Promo' }}) </td>
                    <td>{{ $car->status }}</td>
                    <td>{{ $car->rules }}</td>
                    <td>{{ $car->description }}</td>
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
