<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productRepository;
    protected $productVariantService;

    public function __construct(ProductRepository $productRepository, ProductVariantService $productVariantService)
    {
        $this->productRepository = $productRepository;
        $this->productVariantService = $productVariantService;
    }

    public function index()
    {
        $products = $this->productRepository->getProductsPaginate(24);
        return view('user.products.list.index', compact('products'));
    }

    public function detail($slug)
    {
        $product = $this->productRepository->getProductBySlug($slug);
        $minPrice = $product->variants->map(function ($variant) {
            return ['unit_price' => $variant['unit_price']];
        })->min('unit_price');
        $maxPrice = $product->variants->map(function ($variant) {
            return ['unit_price' => $variant['unit_price']];
        })->max('unit_price');
        $totalAmountProduct = $product->variants->map(function ($variant) {
            return ['amount' => $variant['amount']];
        })->sum('amount');

        $productAttributes = $product->attributes->mapWithKeys(function ($attrValue) {
            return [$attrValue->attribute->id => $attrValue->attribute->name];
        });
        $attrValues = $product->attributes->mapToGroups(function ($attrValue) {
            return [$attrValue->attribute->id => [$attrValue->id => $attrValue->name]];
        })->map(function ($item) {
            $item = $item->mapWithKeys(function ($item) {
                return [array_keys($item)[0] => array_values($item)[0]];
            });
            return $item;
        });
        return view('user.products.detail.index', compact(
            'product',
            'minPrice',
            'maxPrice',
            'totalAmountProduct',
            'productAttributes',
            'attrValues')
        );
    }

    public function getVariantPrice(Request $request)
    {
        $response = $this->productVariantService->handleVariantPrice($request->all());
        return response()->json($response);
    }
}
