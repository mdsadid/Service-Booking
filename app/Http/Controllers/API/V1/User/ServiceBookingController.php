<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceBookingRequest;
use App\Http\Resources\V1\BookingResource;
use App\Http\Resources\V1\ServiceResource;
use App\Models\Service;
use Symfony\Component\HttpFoundation\Response;

class ServiceBookingController extends Controller
{
    public function getAllServices()
    {
        $services = Service::where('status', 1)
            ->latest('id')
            ->paginate(10);

        return ServiceResource::collection($services);
    }

    public function bookService(ServiceBookingRequest $request)
    {
        $validated = $request->validated();
        $user      = auth()->user();

        $booking = $user->bookings()->create($validated);

        $booking->refresh()->load('service');

        return response()->json([
            'message' => 'Service booked successfully.',
            'booking' => new BookingResource($booking),
        ], Response::HTTP_CREATED);
    }

    public function getAllBookings()
    {
        $bookings = auth()->user()->bookings()
            ->with('service')
            ->latest('id')
            ->paginate(10);

        return BookingResource::collection($bookings);
    }
}
