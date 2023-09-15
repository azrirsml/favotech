<x-app-layout>
    <x-card title="Edit Cars">
        <form action="{{ route('cars.update', $car) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-error />

            <div class="row">
                <div class="col-6 mb-8">
                    <label class="fw-bold" for="name">Car Name</label>
                    <input class="form-control mt-1" name="name" type="text" value="{{ old('name', $car->name) }}" />
                </div>
                <div class="col-6">
                    <label class="fw-bold">Type</label>
                    <select class="form-select mt-1" name="car_type_id">
                        <option value="">- Select Car Type -</option>
                        @foreach ($carTypes as $carType)
                            <option value="{{ $carType->id }}" @selected(old('car_type_id', $car->car_type_id) == $carType->id)>{{ ucwords($carType->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 mb-8">
                    <label class="fw-bold">Rent Price</label>
                    <input class="form-control mt-1" name="rent_price" type="text" value="{{ old('rent_price', $car->rent_price) }}" required />
                </div>
                <div class="col-6 mb-8">
                    <label class="fw-bold">Promo Price (if any)</label>
                    <input class="form-control mt-1" name="promo_price" type="text" value="{{ old('promo_price', $car->promo_price) }}" />
                </div>
                <div class="col-6 mb-8">
                    <label class="fw-bold">Status</label>
                    <select class="form-select mt-1" name="status">
                        <option value="">- Select Car Status -</option>
                        <option value="available" @selected(old('status', $car->status) == 'available')>Available</option>
                        <option value="not available" @selected(old('status', $car->status) == 'not available')>Not Available</option>
                    </select>
                </div>
                <div class="col-6 mb-8">
                    <label class="fw-bold" for="date">Available Date</label>
                    <input class="form-control mt-1" name="available_date" type="datetime-local" value="{{ old('available_date', $car->available_date) }}" required />
                </div>
                <div class="col-12 mb-8">
                    <label class="fw-bold">Description</label>
                    <textarea class="form-control mt-1" name="description" cols="30" rows="10">{{ old('description', $car->description) }}</textarea>
                </div>
                <div class="col-12 mb-8">
                    <label class="fw-bold">Rules</label>
                    <textarea class="form-control mt-1" name="rules" cols="30" rows="10">{{ old('rules', $car->rules) }}</textarea>
                </div>

                <div class="col-12">
                    <label class="fw-bold">Images</label>
                    <input class="form-control mt-1" name="images[]" type="file" multiple />
                    </select>
                </div>
            </div>

            <div class="separator my-5"></div>
            <div class="float-end">
                <button class="btn btn-sm btn-primary" type="submit">Update</button>
            </div>
        </form>
    </x-card>
</x-app-layout>
