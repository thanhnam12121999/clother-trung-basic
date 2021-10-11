<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentService extends BaseService
{
    protected $customerRepository;
    protected $productRepository;
    protected $orderReposigory;

    public function __construct(
        CustomerRepository $customerRepository,
        ProductRepository $productRepository,
        OrderRepository $orderReposigory)
    {
        $this->customerRepository = $customerRepository;
        $this->productRepository = $productRepository;
        $this->orderReposigory = $orderReposigory;
    }

    public function handlePayment(Request $request)
    {
        try {
            DB::beginTransaction();
            $customer = null;
            if (!isMemberLogged()) {
                $customerInfo = $request->only(['name', 'address', 'phone_number', 'email']);
                $customer = $this->customerRepository->create($customerInfo);
            }
            $total = (int)str_replace(".","",getCartTotal());
            $orderData = [
                'member_id' => isMemberLogged() ? getAccountInfo()->id : null,
                'customer_id' => isMemberLogged() ? null : $customer->id,
                'price_total' => $total,
                'order_status' => Order::WAITING_CONFIRM_STATUS,
                'note' => $request->get('note'),
                'payment_method' => $request->get('payment_method')
            ];
            $order = $this->orderReposigory->create($orderData);
            if ($order->id) {
                $cart = getCart();
                foreach ($cart as $item) {
                    $order->orderDetails()->create([
                        'product_variant_id' => $item['options']['variant_id'],
                        'amount' => $item['qty']
                    ]);
                }
            }
            DB::commit();
            return $this->sendResponse('Đặt hàng thành công');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Đặt hàng thất bại');
    }
}
