<?php

namespace App\Repositories;

use App\Models\ShoppingCart;

class CartRepository extends BaseRepository
{
    public function model()
    {
        return ShoppingCart::class;
    }

    public function getCartByMember($id)
    {
        return $this->model->where('identifier', $id)->first();
    }

    public function getCartItem() {
        return $this->model->where('identifier', getAccountInfo()->id)->first();
    }
}
