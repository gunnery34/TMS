<?php

namespace App\Http\Controllers;

use App\Models\Summary;
use App\Services\SummaryService;
use App\Http\Resources\BaseResource;
use App\Http\Requests\SummaryRequest;
use App\Http\Resources\SummaryResource;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        return SummaryResource::collection(
            Summary::when($search, function ($query, $search) {
                    return $query->where("name", "like", "%{$search}%");
            })->paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SummaryRequest $request, SummaryService $service)
    {
        $summary = $service->store($request->validated());
        return new SummaryResource($summary);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Summary $summaries)
    {
        return new SummaryResource($summaries);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Summary $summary, SummaryRequest $request, SummaryService $service)
    {
        $summary = $service->update($summary, $request->validated());
        return new SummaryResource($summary);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Summary::findOrFail($id)->delete();
        return new BaseResource([], "Summary Deleted.");
    }

    public function search(Request $request)
    {
        $result = Summary::when($request->q, function ($query) use ($request) {
            $query->where("name", "LIKE", "%" . $request->q . "%");
        })
            ->paginate(5)
            ->withQueryString();

        return SummaryResource::collection($result);
    }
}
