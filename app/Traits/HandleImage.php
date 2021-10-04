<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 *
 */
trait HandleImage
{
    public function createImage($image, $folder, $isMultiple = false)
    {
        if ($isMultiple) {
            $imageList = $image;
            $listImageName = [];
            foreach ($imageList as $img) {
                $imageName = $this->handleUploadImage($img, $folder);
                array_push($listImageName, ['image' => $imageName]);
            }
            return $listImageName;
        } else {
            $imageName = $this->handleUploadImage($image, $folder);
            return $imageName;
        }
    }

    private function handleUploadImage($image, $folder)
    {
        $imageName = time() . '-' . $image->getClientOriginalName();
        $filePath = "images/${folder}/{$imageName}";
        Storage::disk('public')->put($filePath, file_get_contents($image), 'public');
        if (!Storage::disk('public')->exists($filePath)) {
            return null;
        }
        return $imageName;
    }

    public function deleteImage($imageName, $folder)
    {
        try {
            $imagePath = "images/{$folder}/{$imageName}";
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            return true;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }

    public function deleteMultipleImages($listImage)
    {
        try {
            $listImage->each(function ($image) {
                $this->deleteImage($image->image, 'products');
            });
            return true;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
}
