<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

/**
 * 
 */
trait HandleImage
{
    public $pathImageProduct = 'admin/products/images/';

    public function getNameFile($image)
    {
        return $image->getClientOriginalName();
    }

    // public function updateFileImage($request, $avatar, $avatarRequest)
    // {
    //     if ($request->hasFile($avatarRequest)) {
    //         $image = $request->file($avatarRequest);
    //         $imageName = $this->getNameFile($image);
    //         $this->deleteImage($avatar);
    //         $this->moveImage($image, $imageName);
    //     } else {
    //         $imageName  = $avatar;
    //     }
    //     return $imageName;
    // }

    public function creatFileImage($request, $avatarRequest)
    {
        if(!File::exists($this->pathImageProduct)) {
            return false;
        }
        if ($request->hasFile($avatarRequest)) {
        $avatarImg = $request->file($avatarRequest);
        $newName  = rand() . '-' . $avatarImg->getClientOriginalName();
        $this->moveImage($avatarImg, $newName);
        return $newName;
        };
    }

    public function creatMutilFileImage($request, $mutilpleImageRequest)
    {
        if(!File::exists($this->pathImageProduct)) {
            return false;
        }
        if ($request->hasFile($mutilpleImageRequest)) {
            $data = [];
            $images = $request->file($mutilpleImageRequest);
            foreach ($images as $index => $image) {
                $fileName = rand() . '-' . $image->getClientOriginalName();
                $this->moveImage($image, $fileName);
                array_push($data, ['image' => $fileName]);
            }
            return $data;
        }
    }

    public function deleteMutilImage($product)
    {
        if(!File::exists($this->pathImageProduct)) {
            return false;
        }
        foreach ($product->images as $image) {
            return File::delete($this->pathImageProduct . $image->image);
        }
    }

    public function deleteImage($imageName)
    {
        File::delete($this->pathImageProduct . $imageName);
        return true;
    }

    public function moveImage($image, $imageName)
    {
        $image->move(public_path($this->pathImageProduct), $imageName);
    }
}
 