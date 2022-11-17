<?php

namespace App\Http\Controllers;

use App\Models\ItemPackage;
use App\Http\Resources\BaseResource;
use App\Services\ItemPackageService;
use App\Http\Requests\ItemPackageRequest;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\ItemPackageResource;
use Illuminate\Http\Request;

class ItemPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idItem)
    {
        return ItemPackageResource::collection(ItemPackage::where('package_item_id', $idItem)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ItemPackageRequest $request, ItemPackageService $service)
    {
        $itemPackage = $service->store($request->validated());

        return new ItemPackageResource($itemPackage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ItemPackage $itemPackage)
    {
        return new ItemPackageResource($itemPackage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(
        ItemPackage $itemPackage,
        ItemPackageRequest $request,
        ItemPackageService $service
    )
    {
        $itemPackages = $service->update($itemPackage, $request->validated());
        return new ItemPackageResource($itemPackages);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ItemPackage::findOrFail($id)->delete();
        return new BaseResource([], "Item Package Deleted.");
    }
}
