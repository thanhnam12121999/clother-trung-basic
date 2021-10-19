<?php

namespace App\Services;

use App\Models\Order;
use App\Notifications\OrdersNotification;
use App\Repositories\AccountRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class PaymentService extends BaseService
{
    protected $customerRepository;
    protected $productRepository;
    protected $orderReposigory;
    protected $accountRepository;

    public function __construct(
        CustomerRepository $customerRepository,
        ProductRepository $productRepository,
        OrderRepository $orderReposigory,
        AccountRepository $accountRepository
    ) {
        $this->customerRepository = $customerRepository;
        $this->productRepository = $productRepository;
        $this->orderReposigory = $orderReposigory;
        $this->accountRepository = $accountRepository;
    }

    public function handlePayment(Request $request)
    {
        try {
            DB::beginTransaction();
            $customer = null;
            $customerInfo = $request->only(['name', 'address', 'phone_number', 'email']);
            if (!isMemberLogged()) {
                $customer = $this->customerRepository->create($customerInfo);
            }
            $total = (int)str_replace(".","",getCartTotal());
            $orderData = [
                'member_id' => isMemberLogged() ? getAccountInfo()->id : null,
                'customer_id' => isMemberLogged() ? null : $customer->id,
                'name' => $customerInfo['name'],
                'address' => $customerInfo['address'],
                'phone_number' => $customerInfo['phone_number'],
                'email' => $customerInfo['email'],
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

            if (isMemberLogged()) {
                Notification::send(
                    getLoggedInUser(),
                    new OrdersNotification($order, Order::WAITING_CONFIRM_STATUS, false)
                );
            }
            $managerAccounts = $this->accountRepository->getAccountManager();
            $managerAccounts->each(function ($account) use ($order) {
                Notification::send(
                    $account,
                    new OrdersNotification($order, Order::WAITING_CONFIRM_STATUS)
                );
            });
            DB::commit();
            return $this->sendResponse('Đặt hàng thành công');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Đặt hàng thất bại');
    }
}
