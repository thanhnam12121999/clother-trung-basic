<?php

namespace App\Repositories;

use App\Models\ProductVariant;

class ProductVariantRepository extends BaseRepository
{
    public function model()
    {
        return ProductVariant::class;
    }

    public function getVariantsByProductId($productId)
    {
        return $this->model->where('product_id', $productId)->get();
    }

    public function getVariantByVariantValue($variantValue)
    {
        return $this->model->where('variant_value', $variantValue)->get();
    }

    public function getVariantsHasVariantTextIsNull()
    {
        return $this->model->whereNull('variant_text')->get();
    }
}