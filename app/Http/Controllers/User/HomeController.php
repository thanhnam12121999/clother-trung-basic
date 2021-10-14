<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMemberAccountRequest;
use App\Services\AccountService;
use App\Services\ProductService;
use App\Services\SlideService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $accountService;
    protected $slideService;
    protected $productService;

    public function __construct(
        ProductService $productService, 
        AccountService $accountService, 
        SlideService $slideService
    ) {
        $this->accountService = $accountService;
        $this->slideService = $slideService;
        $this->productService = $productService;
    }

    public function index()
    {
        $slides = $this->slideService->getSlideToShow($limit = 4);
        $products = $this->productService->getProductFeature($limit = 8);
        return view('user.home.index', compact('slides', 'products'));
    }
}
