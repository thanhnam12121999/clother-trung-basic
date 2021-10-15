<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $orderService;

    public function __construct(OrderRepository $orderRepository, OrderService $orderService)
    {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }

    public function index(Request $request) {
        $orders = $this->orderRepository->getAllOrders($request);
        return view('admin.order.index', compact('orders'));
    }

    public function detail(Order $order)
    {
        $orderDetails = $order->orderDetails;
        return view('admin.order.detail', compact('orderDetails', 'order'));
    }

    public function updateStatus(Order $order, Request $request)
    {
        if (!$request->has('order_status')) {
            return redirect()->back()->with('error_msg', 'Cập nhật đơn hàng thất bại');
        }
        $response = $this->orderService->updateStatus($order, $request);
        if (!$response['success']) {
            return redirect()->back()->with('error_msg', $response['message']);
        }
        return redirect()->back()->with([
            'success_msg' => $response['message'],
            'errors' => $response['data']['errors']
        ]);
    }
}
