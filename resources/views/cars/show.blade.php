<x-app-layout>
    <x-card title="Rent Cars">

        <div class="row">
            <div class="col-12 col-md-6">
                <label class="form-label text-gray-400">Owner Name</label>
                <p class="fw-bold fs-6 text-uppercase">{{ $car->owner?->name }}</p>

                <label class="form-label text-gray-400">Owner Details</label>
                <p class="fw-bold fs-6 text-uppercase">Address: {{ $car->address }}</p>
                <p class="fw-bold fs-6 text-uppercase">Bank: {{ $car->owner?->bank?->name }}</p>
                <p class="fw-bold fs-6 text-uppercase">Bank No:{{ $car->owner?->bank_number }}</p>
            </div>

            <div class="col-12 col-md-6">
                <label class="form-label text-gray-400">Available Date</label>
                <p class="fw-bold fs-6 text-uppercase">{{ $car->available_date }}</p>
            </div>
        </div>
    </x-card>

    <x-card>
        <form action="{{ route('rents.store', $car) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6 mb-8">
                    <label class="fw-bold" for="date">Start Date</label>
                    <input class="form-control mt-1" name="start_date" type="datetime-local" value="{{ old('start_date') }}" required />
                </div>
                <div class="col-6 mb-8">
                    <label class="fw-bold" for="date">End Date</label>
                    <input class="form-control mt-1" name="end_date" type="datetime-local" value="{{ old('end_date') }}" required />
                </div>
                <div class="col-12">
                    <label class="fw-bold">Receipt</label>
                    <input class="form-control mt-1" name="receipt" type="file" />
                    </select>
                </div>
            </div>

            <button class="btn btn-primary btn-sm mt-5">Rent Now</button>
        </form>
    </x-card>
</x-app-layout>
