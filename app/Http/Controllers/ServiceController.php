<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\ServiceService;
use App\Http\Resources\BaseResource;
use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get("search");
        return ServiceResource::collection(
            Service::when($search, function ($query, $search) {
                    return $query->where("name", "like", "%{$search}%");
            })->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request, ServiceService $service)
    {
        $serviceCreate = $service->store($request->validated());
        return new ServiceResource($serviceCreate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Service $service, ServiceService $serviceService, ServiceRequest $request)
    {
        $serviceUpdate = $serviceService->update($service, $request->validated());
        return new ServiceResource($serviceUpdate);
    }

    public function destroy(Service $service)
    {
        $service->delete($service);
        return new BaseResource([], "Service Deleted.");
    }
}
