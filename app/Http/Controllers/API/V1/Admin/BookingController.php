<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BookingResource;
use App\Models\Booking;

class BookingController extends Controller
{
    public function __invoke()
    {
        $bookings = Booking::with(['user', 'service'])
            ->latest('id')
            ->paginate(10);

        return BookingResource::collection($bookings);
    }
}
