<?php 

namespace App\Helpers;

use App\Models\Branch;
use File;

class UploadHelper
{
    public static function uploadBrandImage($request)
    {
        if($request->hasFile('image')) {  
            $file = $request->file('image');
            $image_name = time().".".$file->getClientOriginalName();
            $file->move(public_path('uploads/images/brand'), $image_name);
            return $image_name;
        }

        return null;
    }

    public static function deleteOldBrandImage($imageName)
    {
        $imagePath = public_path('uploads/images/brand/'.$imageName);
         
        if(File::exists($imagePath)){
            unlink($imagePath);
        }
    }

    public static function uploadBranchImages($request,Branch $branch)
    {
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
    } 

    public static function deleteOldBranchImages(Branch $branch)
    {
        foreach ($branch->images as $image) {
            $imagePath = public_path('uploads/images/branch/'.$image->image);
         
            if(File::exists($imagePath)){
                unlink($imagePath);
            } 
          } 
    }
}

