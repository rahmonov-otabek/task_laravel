<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Http\Resources\BrandCollection;
use File;

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
        
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $image_name = time().".".$file->getClientOriginalExtension();
            $file->move(public_path('uploads/images/brand'), $image_name);
            $validated['image'] = $image_name;
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
         
        if($request->hasFile('image')) { 
            $imagePath = public_path('uploads/images/brand/'.$brand->image);
            if(File::exists($imagePath)){
                unlink($imagePath);
            }
            $file = $request->file('image');
            $image_name = time().".".$file->getClientOriginalExtension();
            $file->move(public_path('uploads/images/brand'), $image_name);
            $validated['image'] = $image_name;
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
