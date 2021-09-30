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

    public function creatFileImage($request, $avatarRequest)
    {
        if(!File::exists($this->pathImageProduct)) {
            return false;
        }
        if ($request->hasFile($avatarRequest)) {
        $dataImage = $request->file($avatarRequest);
        $newName  = rand() . '-' . $dataImage->getClientOriginalName();
        // $this->moveImage($avatarImg, $newName);
        return [
            'nameImage' => $newName,
            'dataImage' => $dataImage
        ];
        };
        return false;
    }

    public function creatMutilFileImage($request, $mutilpleImageRequest)
    {
        if(!File::exists($this->pathImageProduct)) {
            return false;
        }
        if ($request->hasFile($mutilpleImageRequest)) {
            $listNameImg = [];
            $dataImages = [];
            $images = $request->file($mutilpleImageRequest);
            foreach ($images as $index => $image) {
                $fileName = rand() . '-' . $image->getClientOriginalName();
                // $this->moveImage($image, $fileName);
                array_push($listNameImg, ['image' => $fileName]);
                array_push($dataImages, $image);
            }
            return [
                'listNameImg' => $listNameImg,
                'dataImg' => $dataImages
            ];
        }
        return false;
    }

    public function deleteMutilImage($listImage)
    {
        if(!File::exists($this->pathImageProduct)) {
            return false;
        }
        foreach ($listImage as $image) {
            File::delete($this->pathImageProduct . $image->image);
        }
        return true;
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

    public function moveMutipleImages($dataImages)
    {
        foreach ($dataImages['listNameImg'] as $index => $image) {
            $dataImages['dataImg'][$index]->move(public_path($this->pathImageProduct), $image['image']);
        }
    }
}
 