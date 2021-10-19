<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Repositories\MemberRepository;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $memberRepository;
    protected $orderRepository;

    public function __construct(MemberRepository $memberRepository, OrderRepository $orderRepository)
    {
        $this->memberRepository = $memberRepository;
        $this->orderRepository = $orderRepository;
    }

    public function index() {
        $membersCount = $this->memberRepository->all()->count();
        $ordersCount = $this->orderRepository->all()->count();

        return view('admin.dashboard.index', compact('membersCount', 'ordersCount'));
    }
}
