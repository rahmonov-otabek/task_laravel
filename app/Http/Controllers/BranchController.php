<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Http\Resources\BranchResource;
use App\Http\Resources\BranchCollection;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\Branch;
use App\Helpers\UploadHelper;

/**
 * @group Branch
 * 
 */
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = QueryBuilder::for(Branch::class)
            ->allowedFilters(['brand_id', 'region_id', 'district_id'])
            ->get();

        return new BranchCollection($branches);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {
        $validated = $request->validated();

        $branch = Branch::create($validated);  

        if(!empty($validated['images'])) { 
            UploadHelper::uploadBranchImages($request, $branch);
        } 
        

        return new BranchResource($branch);
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        return (new BranchResource($branch))
            ->load('brand')
            ->load('images');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        $validated = $request->validated();

        $branch->update($validated);
 
        if(!empty($validated['images'])) {
            UploadHelper::deleteOldBranchImages($branch);
            UploadHelper::uploadBranchImages($request, $branch);
        }  

        return new BranchResource($branch);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return response()->noContent();
    }
}
