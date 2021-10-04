<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\AttributeRepository;
use App\Repositories\AttributeValueRepository;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $attributeRepository;
    protected $attributeValueRepo;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        AttributeRepository $attributeRepository,
        AttributeValueRepository $attributeValueRepo
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->attributeRepository = $attributeRepository;
        $this->attributeValueRepo = $attributeValueRepo;
    }

    public function index() {
        $products = $this->productService->getAll();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAll();
        $attributes = $this->attributeRepository->all();
        $attributeValues = $this->attributeValueRepo->getAttributeValues();
        return view('admin.product.insert', compact('categories', 'attributes', 'attributeValues'));
    }

    public function store(StoreProductRequest $request)
    {
        $response = $this->productService->store($request);
        if ($response['success']) {
            return redirect()->route('admin.products.index')->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message'])->withInput();

    }

    public function show(int $id)
    {
        $product = $this->productService->getById($id);
        return view('admin.product.view', compact('product'));
    }

    public function edit(int $id)
    {
        $categories = $this->categoryService->getAll();
        $product = $this->productService->getById($id);
        $attributes = $this->attributeRepository->all();
        $attributeValues = $this->attributeValueRepo->getAttributeValues();
        return view('admin.product.edit', compact('product', 'categories', 'attributes', 'attributeValues'));
    }

    public function update(int $id, UpdateProductRequest $request)
    {
        $response = $this->productService->update($id, $request);
        if ($response['success']) {
            return redirect()->route('admin.products.index')->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }

    public function destroy(int $id)
    {
        $response = $this->productService->delete($id);
        if ($response['success']) {
            return redirect()->back()->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }
}
