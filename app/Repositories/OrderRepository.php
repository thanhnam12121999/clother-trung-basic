<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    public function model()
    {
        return Order::class;
    }

    public function getMemberOrders()
    {
        return $this->model->with(['orderDetails', 'orderDetails.productVariant'])
            ->where('member_id', getAccountInfo()->id)
            ->get();
    }
}
