<?php

namespace App\Services;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Traits\HandleImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductService extends BaseService
{
    use HandleImage;

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function store($request) {
        try {
            DB::beginTransaction();
            $newNameImg = $this->creatFileImage($request, 'feature_image');
            $listNameImg = $this->creatMutilFileImage($request, 'image_list');
            if (!$newNameImg && !$listNameImg) {
                return $this->sendError('Lỗi thêm hình ảnh, thêm sản phẩm thất bại.');
            }
            $dataProduct = $this->fillDataProduct($request, $newNameImg);
            $product = $this->productRepository->create($dataProduct);
            $product->images()->createMany($listNameImg);
            DB::commit();
            return $this->sendResponse('Sản phẩm đã được thêm thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại');
    }

    public function fillDataProduct($request, $newNameImg) {
        return [
            'category_id' => $request->cate_id,
            'name' => $request->name,
            'code' => Str::random(10),
            'feature_image' => $newNameImg,
            'summary' => $request->summary,
            'detail' => $request->sort_desc,
            'description' => $request->detail,
            'status' => $request->status,
        ];
    }

    public function getAll()
    {
        return $this->productRepository->getAllPorudctAndLoadCate();
    }

    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function getAllImageById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function update($id, $request)
    {
        try {
            DB::beginTransaction();
            $product = $this->productRepository->find($id);
            $dataUpdate = [
                'name' => $request->name,
                'category_id' => $request->cate_id,
                'summary' => $request->summary,
                'description' => $request->description,
                'detail' => $request->detail,
                'status' => $request->status,
            ];
            if ($request->has('feature_image')) {
                $this->deleteImage($product->feature_image);
                $newImg = $this->creatFileImage($request, 'feature_image');
                $dataUpdate['feature_image'] = $newImg;
            }
            if ($request->has('image_list')) {
                $this->deleteMutilImage($product);
                $this->productRepository->deleteImages($id);
                $listNameImg = $this->creatMutilFileImage($request, 'image_list');
                $product->images()->createMany($listNameImg);
            }
            $this->productRepository->update($id, $dataUpdate);
            DB::commit();
            return $this->sendResponse('Sản phẩm đã được sửa thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return $this->sendResponse('Sửa thất bại');
    }

    public function delete($id)
    {
        $product = $this->productRepository->find($id);
        $this->deleteMutilImage($product);
        $this->productRepository->deleteImages($id);
        $this->deleteProduct($id, $product);
        return $this->sendResponse('Xóa sản phẩm thành công.');
    }

    public function deleteProduct($id, $product)
    {
        $this->deleteImage($product->feature_image);
        $this->productRepository->delete($id);
        return true;
    }
}