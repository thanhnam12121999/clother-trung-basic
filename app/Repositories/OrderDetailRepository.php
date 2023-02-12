<?php

namespace App\Repositories;

use App\Models\OrderDetail;

class OrderDetailRepository extends BaseRepository
{
    public function model()
    {
        return OrderDetail::class;
    }

    public function getOrderByVariantId($variantId)
    {
        return $this->model
            ->where('product_variant_id', $variantId)
            ->get();
    }
}
