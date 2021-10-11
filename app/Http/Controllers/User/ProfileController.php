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

        $orderStatus = [
            Order::WAITING_CONFIRM_STATUS => 'Chờ xác nhận',
            Order::CONFIRMED_DELIVERY_STATUS => 'Đang giao',
            Order::DELIVERED_STATUS => 'Đã giao',
            Order::CANCEL_STATUS => 'Đã hủy'
        ];
        return view('user.profile.order', compact('orders', 'orderStatus'));
    }
}
