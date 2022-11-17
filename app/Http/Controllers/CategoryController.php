<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\BaseResource;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get("search");

        return CategoryResource::collection(
            Category::when($search, function ($query, $search) {
                return $query->where("name", "like", "%{$search}%")
                    ->orWhere("code", "like", "%{$search}%");
            })->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, CategoryService $service)
    {
        $category = $service->store($request->validated());
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, CategoryRequest $request, CategoryService $service)
    {
        $category = $service->update($category, $request->validated());
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return new BaseResource([], "Category Deleted.");
    }

    public function search(Request $request)
    {
        $result = Category::when($request->q, function ($query) use ($request) {
            $query->where("name", "LIKE", "%" . $request->q . "%");
        })
            ->paginate(5)
            ->withQueryString();

        return CategoryResource::collection($result);
    }
}
