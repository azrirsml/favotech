<x-app-layout>
    <x-card title="Manage Rents">

        <x-table>
            <x-slot:header>
                <th>ID</th>
                <th>Owner Name</th>
                <th>Tenant Name</th>
                <th>Car</th>
                <th>Price</th>
                <th>Status</th>
                <th>Pickup Address</th>
                <th>Start Date</th>
                <th></th>
            </x-slot:header>

            @foreach ($rents as $rent)
                <tr>
                    <td>{{ $rent->id }}</td>
                    <td>{{ $rent->car?->owner?->name }}</td>
                    <td>{{ $rent->tenant?->name }}</td>
                    <td>{{ $rent->car?->name }}</td>
                    <td>{{ $rent->car?->rent_price }}</td>
                    <td>{{ $rent->status }}</td>
                    <td>{{ $rent->status == 'success' ? $rent->car?->owner?->address : 'Payment Not Yet Confirmed' }}</td>
                    <td>{{ $rent->start_date }}</td>
                    <td>
                        <div class="btn btn-group">
                            @role('owner')
                                @if ($rent->status == 'pending')
                                    <a class="btn btn-primary btn-sm" href="{{ route('payment_received', $rent) }}">Payment Received</a>
                                @endif
                            @else
                                @if ($rent->start_date?->format('Y-m-d') == today()->format('Y-m-d'))
                                    <a class="btn btn-primary btn-sm" href="{{ route('rates.create', ['car' => $rent->car]) }}">Rate</a>
                                @endif
                            @endrole
                            <a class="btn btn-secondary btn-sm" href="{{ $rent->getFirstMediaUrl('receipts') }}" target="_blank">Receipt</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-table>
    </x-card>
</x-app-layout>
