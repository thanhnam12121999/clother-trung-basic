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

    public function getProductFeature($limit)
    {
        return $this->model->latest()->take($limit)->get();
    }

    public function getProductInterested($limit)
    {
        return $this->model->inRandomOrder()->limit($limit)->get();
    }

    public function getById($id)
    {
        return $this->model->with('variants')->find($id);
    }

    public function deleteImagesRelation($product)
    {
        foreach ($product->images as $image) {
            $image->delete();
        }
    }

    public function getProductsPaginate($perPage = 10)
    {
        return $this->model->paginate($perPage);
    }

    public function getProductBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function createMutilImage()
    {
        return ;
    }
}
