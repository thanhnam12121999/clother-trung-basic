<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentInfoRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function index()
    {
        if (getCartTotal()) {
            return view('user.payment.index');
        }
        toast('Mua hàng đã rồi mới thanh toán chứ bạn ^^', 'warning')->autoClose(3000);
        return redirect()->route('products.index');
    }

    public function handlePayment(PaymentInfoRequest $request)
    {
        $response = $this->paymentService->handlePayment($request);
        if ($response['success']) {
            return redirect()->route('products.index')->with('success', $response['message']);
        }
        alert()->error($response['message']);
        return redirect()->route('products.index');
    }
}
