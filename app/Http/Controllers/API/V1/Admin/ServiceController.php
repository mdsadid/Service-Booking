<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\V1\ServiceResource;
use App\Models\Service;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest('id')->paginate(10);

        return ServiceResource::collection($services);
    }

    public function store(ServiceRequest $request)
    {
        $validated = $request->validated();
        $service   = Service::create($validated);

        return response()->json([
            'message' => 'Service created successfully.',
            'service' => new ServiceResource($service),
        ], Response::HTTP_CREATED);
    }

    public function show(Service $service)
    {
        return response()->json([
            'service' => new ServiceResource($service),
        ]);
    }

    public function update(ServiceRequest $request, Service $service)
    {
        $validated = $request->validated();

        $service->update($validated);

        $service->refresh();

        return response()->json([
            'message' => 'Service updated successfully.',
            'service' => new ServiceResource($service),
        ]);
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return response()->json([
            'message' => 'Service deleted successfully.',
        ]);
    }
}
