<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Traits\HandleImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryService extends BaseService
{
    use HandleImage;

    protected $categoryRepository;
    protected $productService;

    public function __construct(CategoryRepository $categoryRepository, ProductService $productService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productService = $productService;
    }

    public function getAll()
    {
        return $this->categoryRepository->all();
    }

    public function handle(Request $request, $category = null)
    {
        try {
            $categoryData = $request->only(['name', 'description']);
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                if (!empty($category) && !empty($category->image)) {
                    $this->deleteImage($category, 'categories');
                }
                $imageName = $this->createImage($request->file('image'), 'categories');
                if (!$imageName) {
                    return $this->sendError('Lỗi thêm ảnh danh mục, vui lòng thử lại', Response::HTTP_BAD_REQUEST);
                }
                $categoryData['image'] = $imageName;
            }
            $responseMsg = '';
            if (empty($category)) {
                $responseMsg = 'Thêm danh mục thành công';
                $this->categoryRepository->create($categoryData);
            } else {
                $responseMsg = 'Chỉnh sửa danh mục thành công';
                $this->categoryRepository->update($category->id, $categoryData);
            }
            DB::commit();
            return $this->sendResponse($responseMsg);
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại');
    }

    public function delete($category)
    {
        try {
            DB::beginTransaction();
            $isDelete = $this->deleteImage($category->image, 'categories');
            if (!$isDelete) {
                throw new \Exception;
            }
            $products = $category->products;
            if ($products->isNotEmpty()) {
                $isDeleteProductsData = $this->productService->deleteMultipleProducts($products);
                if (!$isDeleteProductsData) {
                    throw new \Exception;
                }
            }
            $category->delete();
            DB::commit();
            return $this->sendResponse('Xóa danh mục thành công');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Xóa danh mục thất bại');
    }
}
