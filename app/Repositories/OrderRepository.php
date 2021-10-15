<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderRepository extends BaseRepository
{
    public function model()
    {
        return Order::class;
    }

    public function getAllOrders(Request $request)
    {
        if ($request->has('id') && $request->has('status')) {
            return $this->model->where('id', $request->get('id'))
                ->where('order_status', $request->get('status'))
                ->get();
        }
        return $this->model->all();
    }

    public function getMemberOrders()
    {
        return $this->model->with(['orderDetails', 'orderDetails.productVariant'])
            ->where('member_id', getAccountInfo()->id)
            ->get();
    }
}
