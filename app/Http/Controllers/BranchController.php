<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Http\Resources\BranchResource;
use App\Http\Resources\BranchCollection;
use Spatie\QueryBuilder\QueryBuilder;

use App\Models\Branch;

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
 
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $image_name = time().".".$file->getClientOriginalName();
                $file->move(public_path('uploads/images/branch'), $image_name);

                $branch->images()->create([
                    "image" => $image_name,
                    "branch_id" => $branch->id
                ]); 
            }
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
 
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $image_name = time().".".$file->getClientOriginalName();
                $file->move(public_path('uploads/images/branch'), $image_name);

                $branch->images()->create([
                    "image" => $image_name,
                    "branch_id" => $branch->id
                ]); 
            }
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
