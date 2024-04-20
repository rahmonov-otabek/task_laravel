<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\BrandCollection;
use File;

use App\Helpers\UploadHelper;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();

        return new BrandCollection($brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $validated = $request->validated(); 
        
        if(!empty($validated['image'])) { 
            $validated['image'] = UploadHelper::uploadBrandImage($request);
        } 
        
        $brand = Brand::create($validated);

        return new BrandResource($brand);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return new BrandResource($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $validated = $request->validated(); 

        if(!empty($validated['image'])) {  
            UploadHelper::deleteOldBrandImage($brand->image);
            $validated['image'] = UploadHelper::uploadBrandImage($request);
        }

        $brand->update($validated); 

        return new BrandResource($brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->noContent();
    }
}
