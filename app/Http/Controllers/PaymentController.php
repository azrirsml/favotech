<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Notifications\PickupRentalCar;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Rent $rent)
    {
        if ($rent->status != 'success') {
            $rent->status = 'success';
            $rent->save();

            Rent::where('status', '!=', 'success')->update(['status' => 'fully booked']);

            $rent->car()->update(['status' => 'not available']);
        }

        $tenant = $rent->tenant;

        $address = $rent->car?->owner?->address;

        if ($tenant && $address) {
            $tenant->notify(new PickupRentalCar($address));
        }

        return back();
    }
}
