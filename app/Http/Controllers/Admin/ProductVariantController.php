<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateVariantRequest;
use App\Models\Product;
use App\Services\ProductVariantService;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    protected $productVariantService;

    public function __construct(ProductVariantService $productVariantService)
    {
        $this->productVariantService = $productVariantService;
    }

    public function getVariantsOfProduct(Product $product)
    {
        $variants = $this->productVariantService->getVariantsOfProduct($product);
        return view('admin.product.variants', compact('variants', 'product'));
    }

    public function updateProductVariants(Product $product, UpdateVariantRequest $request)
    {
        if (!empty($request->errors)) {
            return redirect()->back()->with('error_msg', 'Đảm bảo các giá trị không rỗng và là số');
        }
        $response = $this->productVariantService->updateProductVariants($product, $request->validated());
        if ($response['success']) {
            return redirect()->back()->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }
}
