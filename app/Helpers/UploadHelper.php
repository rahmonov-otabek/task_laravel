<?php 

namespace App\Helpers;

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
    
}

