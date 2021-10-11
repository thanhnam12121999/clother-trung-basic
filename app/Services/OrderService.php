<?php

namespace App\Services;

use App\Repositories\AttributeValueRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OrderService extends BaseService
{
    protected $attrValueRepository;

    public function __construct(AttributeValueRepository $attrValueRepository)
    {
        $this->attrValueRepository = $attrValueRepository;
    }
    public function mapMemberOrdersData()
    {
        $orders = getAccountInfo()->orders;
        $orders = $orders->map(function ($order) {
            $orderDetails = $order->orderDetails->map(function ($detail) {
                $attributeValues = json_decode($detail->productVariant->variant);
                $attrValues = $this->attrValueRepository->getAttributeValuesOfProduct($attributeValues);
                $variants = $attrValues->sortBy('attribute_id')->pluck('name')->map(function ($value) {
                    return Str::ucfirst($value);
                });
                return [
                    'product' => $detail->productVariant->product,
                    'variant' => implode("-", $variants->all()),
                    'amount' => $detail->amount,
                    'unit_price' => $detail->productVariant->unit_price
                ];
            });
            return [
                'id' => $order->id,
                'order_code' => strtoupper($order->order_code),
                'price_total' => $order->price_total,
                'order_status' => $order->order_status,
                'note' => $order->note,
                'payment_method' => $order->payment_method,
                'order_details' => $orderDetails->all(),
                'created_at' => Carbon::parse($order->created_at)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::parse($order->updated_at)->format('Y-m-d H:i:s'),
            ];
        })->all();
        return $orders;
    }
}
