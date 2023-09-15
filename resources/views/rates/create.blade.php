<x-app-layout>
    <x-card title="Create Rates">
        <form action="{{ route('rates.store') }}" method="POST">
            @csrf
            <x-error />

            <div class="row">
                <input name="car_id" type="hidden" value="{{ request()->car }}" readonly>

                <div class="col-6 mb-8">
                    <label class="fw-bold" for="name">Comment</label>
                    <textarea class="form-control mt-1" id="" name="comment" cols="30" rows="10">{{ old('comment') }}</textarea>
                </div>
                <div class="col-6">
                    <label class="fw-bold">Rating</label>
                    <select class="form-select mt-1" name="rate">
                        <option value="">- Select Rating -</option>
                        @for ($i = 1; $i < 6; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="separator my-5"></div>
            <div class="float-end">
                <button class="btn btn-sm btn-primary" type="submit">Create</button>
            </div>
        </form>
    </x-card>
</x-app-layout>
