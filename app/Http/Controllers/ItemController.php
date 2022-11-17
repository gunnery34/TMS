<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\ItemService;
use App\Http\Requests\ItemRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get("search");

        return ItemResource::collection(
            Item::when($search, function ($query, $search) {
                return $query->where("name", "like", "%{$search}%");
            })->paginate(10)
        );
    }

    public function searchItemSingleType(Request $request)
    {
        if (!$request->search) {
            return response()->json([], 200);
        }

        $data = Item::where('name', 'like', "%{$request->search}%")
            ->orWhere('description', 'like', "%{$request->search}%")
            ->get();

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request, ItemService $service)
    {
        $item = $service->store($request->validated());
        return new ItemResource($item->loadMissing('itemTax', 'itemService'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Item $item, ItemRequest $request, ItemService $service)
    {
        $item = $service->update($item, $request->validated());
        return new ItemResource($item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::findOrFail($id)->delete();
        return new BaseResource([], "Item Deleted.");
    }

    public function search(Request $request)
    {
        $result = Item::when($request->q, function ($query) use ($request) {
            $query->where("name", "LIKE", "%" . $request->q . "%");
        })
            ->paginate(5)
            ->withQueryString();

        return ItemResource::collection($result);
    }
}
