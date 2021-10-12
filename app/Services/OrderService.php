<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\ProductVariantRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderService extends BaseService
{
    protected $productVariantRepository;

    public function __construct(ProductVariantRepository $productVariantRepository)
    {
        $this->productVariantRepository = $productVariantRepository;
    }

    public function updateStatus(Order $order, Request $request)
    {
        try {
            $orderStatus = $request->get('order_status');
            $errorsQuantity = [];
            DB::beginTransaction();
            if ($orderStatus == Order::CONFIRMED_DELIVERY_STATUS) {
                $order->orderDetails->each(function ($detail) {
                    $quantity = $detail->productVariant->amount - $detail->amount;
                    if ($quantity <= 0) {
                        $errorsQuantity[] = [
                            $detail->product_variant_id => "Số lượng mua sản phẩm {$detail->productVariant->product->name} ({$detail->productVariant->variant_text}) đã vượt quá số lượng trong kho"
                        ];
                        $detail->delete();
                    } else {
                        $detail->productVariant()->lockForUpdate()->update(['amount' => $quantity]);
                    }
                });
            }
            tap($order)->lockForUpdate()->update($request->all());
            DB::commit();
            return $this->sendResponse('Cập nhật đơn hàng thành công', ['errors' => $errorsQuantity]);
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Cập nhật đơn hàng thất bại');
    }

    public function updateOrders(Order $order, Request $request)
    {
        $successMsg = '';
        $errorMsg = '';
        try {
            switch ($request->get('order_status')) {
                case Order::DELIVERED_STATUS:
                    $successMsg = 'Xác nhận đã nhận hàng thành công';
                    $errorMsg = 'Xác nhận đã nhận hàng thất bại';
                    break;
                case Order::CANCEL_STATUS:
                    $successMsg = 'Xác nhận hủy đơn hàng thành công';
                    $errorMsg = 'Xác nhận hủy đơn hàng thật bại';
                    break;
                default:
                    break;
            }
            DB::beginTransaction();
            tap($order)->update($request->all());
            DB::commit();
            return $this->sendResponse($successMsg);
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError($errorMsg);
    }
}
