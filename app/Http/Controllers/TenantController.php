<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxRequest;
use App\Http\Requests\TenantRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\TaxResource;
use App\Http\Resources\TenantResource;
use App\Models\Tenant;
use App\Services\TaxService;
use App\Services\TenantService;
use Symfony\Component\HttpFoundation\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get("search");

        return TenantResource::collection(
            Tenant::when($search, function ($query, $search) {
                return $query->where("name", "like", "%{$search}%");
            })->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TenantRequest $request, TenantService $tenantService)
    {
        $tenant = $tenantService->store($request->validated());
        return new TenantResource($tenant);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TenantResource::collection(Tenant::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Tenant $tenant, TenantRequest $request, TenantService $service)
    {
        $updateTenant = $service->update($tenant, $request->validated());
        return new TenantResource($updateTenant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete($tenant);
        return new BaseResource([], "Tenant Deleted.");
    }
}
