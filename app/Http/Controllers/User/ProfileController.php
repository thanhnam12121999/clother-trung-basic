<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMemberAccountRequest;
use App\Http\Resources\OrderCollection;
use App\Models\Order;
use App\Services\AccountService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $accountService;
    protected $orderService;

    public function __construct(AccountService $accountService, OrderService $orderService) {
        $this->accountService = $accountService;
        $this->orderService = $orderService;
    }

    public function getProfileUser()
    {
        if (!isMemberLogged()) {
            return redirect()->route('home');
        }
        return view('user.profile.index');
    }

    public function updateProfile(int $id, UpdateMemberAccountRequest $request)
    {
        $response = $this->accountService->updateAccountOfMember($id, $request);
        if ($response['success']) {
            return redirect()->back()->with('success', $response['message']);
        }
        return redirect()->back()->with('error', $response['message']);
    }

    public function getViewOrder()
    {
        if (!isMemberLogged()) {
            return redirect()->route('home');
        }
        $orders = getAccountInfo()->orders;
        $waitingOrders = $orders->filter(function ($order) {
            return $order->order_status == Order::WAITING_CONFIRM_STATUS;
        });
        $confirmedOrders = $orders->filter(function ($order) {
            return $order->order_status == Order::CONFIRMED_DELIVERY_STATUS;
        });
        $deliveredOrders = $orders->filter(function ($order) {
            return $order->order_status == Order::DELIVERED_STATUS;
        });
        $cancelOrders = $orders->filter(function ($order) {
            return $order->order_status == Order::CANCEL_STATUS;
        });

        $orderStatus = [
            Order::WAITING_CONFIRM_STATUS => 'Chờ xác nhận',
            Order::CONFIRMED_DELIVERY_STATUS => 'Đang giao',
            Order::DELIVERED_STATUS => 'Đã nhận',
            Order::CANCEL_STATUS => 'Đã hủy'
        ];
        return view('user.profile.order', compact('waitingOrders', 'confirmedOrders', 'deliveredOrders', 'cancelOrders', 'orderStatus'));
    }

    public function updateOrders(Order $order, Request $request)
    {
        $response = $this->orderService->updateOrders($order, $request);
        if ($response['success']) {
            toast($response['message'], 'success')->autoClose(3000);
            return redirect()->back();
        }
        toast($response['message'], 'error')->autoClose(3000);
        return redirect()->back();
    }
}
