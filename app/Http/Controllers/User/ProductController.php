<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->getProductsPaginate(24);
        return view('user.products.list.index', compact('products'));
    }

    public function detail($slug)
    {
        $product = $this->productRepository->getProductBySlug($slug);
        return view('user.products.detail.index', compact('product'));
    }
}
