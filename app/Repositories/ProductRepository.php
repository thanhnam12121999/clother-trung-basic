<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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

    public function deleteImagesRelation($product)
    {
        foreach ($product->images as $image) {
            $image->delete();
        }
    }

    public function getProductsPaginate(Request $request, $perPage = 10)
    {
        $query = $this->model->paginate($perPage);
        if ($request->has('keyword')) {
            $keyword = $request->get('keyword');
            $query = $this->model->where('name', 'like', "%{$keyword}%")
                ->orWhere('slug', 'like', "%{$keyword}%")
                ->orWhere('summary', 'like', "%{$keyword}%")
                ->orWhere('detail', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%")
                ->orWhereHas('attributes', function (Builder $q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                })
                ->orWhereHas('category', function (Builder $q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                        ->orWhere('slug', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%");
                })
                ->paginate($perPage);
        }
        return $query;
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
