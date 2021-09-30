<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return Product::class;
    }

    public function getAllPorudctAndLoadCate()
    {
        return $this->model->with('category')->get();
    }

    public function getById($id)
    {
        return $this->model->with('variants')->find($id);
    }

    public function deleteImages($id)
    {
        $product = $this->find($id);
        foreach ($product->images  as $image) {
            $image->delete();
        }
        return $product;
    }

    public function createMutilImage()
    {
        return ;
    }
}