<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index() {
        $products = $this->productService->getAll();
        return view('admin.product.index', compact('products'));
    }

    public function store(StoreProductRequest $request)
    {
        $response = $this->productService->store($request);
        if ($response['success']) {
            return redirect()->route('admin.products.index')->with('success', $response['message']);
        }
        return redirect()->back()->with('error', $response['message']);
        
    }

    public function getFormCreate()
    {
        $categories = $this->categoryService->getAll();
        return view('admin.product.insert', compact('categories'));
    }

    public function show(int $id)
    {
        $product = $this->productService->getById($id);
        return view('admin.product.view', compact('product'));
    }

    public function update(int $id, UpdateProductRequest $request)
    {
        $response = $this->productService->update($id, $request);
        if ($response['success']) {
            return redirect()->route('admin.products.index')->with('success', $response['message']);
        }
        return redirect()->back()->with('error', $response['message']);
    }

    public function getFormEdit(int $id)
    {
        $categories = $this->categoryService->getAll();
        $product = $this->productService->getById($id);
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function destroy(int $id)
    {
        $response = $this->productService->delete($id);
        if ($response['success']) {
            return redirect()->route('admin.products.index')->with('success', $response['message']);
        }
        return redirect()->back()->with('error', $response['message']);
    }
}
