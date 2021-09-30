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
            $dataImage = $this->creatFileImage($request, 'feature_image');
            $dataImages = $this->creatMutilFileImage($request, 'image_list');
            if (!$dataImage || !$dataImages) {
                return $this->sendError('Lỗi thêm hình ảnh, thêm sản phẩm thất bại.');
            }
            $dataProduct = $this->fillDataProduct($request, $dataImage['nameImage']);
            $product = $this->productRepository->create($dataProduct);
            $productImageRelation = $product->images()->createMany($dataImages['listNameImg']);
            // save image file to folder
            if (!empty($product) && !empty($productImageRelation)) {
                $this->moveImage($dataImage['dataImage'], $dataImage['nameImage']);
                $this->moveMutipleImages($dataImages);
            }
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
            $oldImagesRelation = $product->images;
            $newImage = '';
            $dataUpdate = [
                'name' => $request->name,
                'category_id' => $request->cate_id,
                'summary' => $request->summary,
                'description' => $request->description,
                'detail' => $request->detail,
                'status' => $request->status,
            ];
            // create new avatar if have new avatar product
            if ($request->has('feature_image')) {
                $newImage = $this->creatFileImage($request, 'feature_image');
                $dataUpdate['feature_image'] = $newImage['nameImage'];
            }
            // create new images if have new image product
            if ($request->has('image_list')) { 
                $this->productRepository->deleteImagesRelation($id);
                $listImages = $this->creatMutilFileImage($request, 'image_list');
                $newImagesRelation = $product->images()->createMany($listImages['listNameImg']);
                if(!$newImagesRelation) { return false ;}
                $this->moveMutipleImages($listImages);
                $this->deleteMutilImage($oldImagesRelation);
            }
            $productUpdate = $this->productRepository->update($id, $dataUpdate);
            //delete avatar if have new avatar
            if (!empty($productUpdate) && !empty($newImage)) {
                $this->deleteImage($product->feature_image);
                $this->moveImage($newImage['dataImage'], $newImage['nameImage']);
            }
            DB::commit();
            return $this->sendResponse('Sản phẩm đã được sửa thành công.');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return $this->sendError('Sửa thất bại.');
    }

    public function delete($id)
    {
        $product = $this->productRepository->find($id);
        $this->deleteMutilImage($product->images);
        $this->productRepository->deleteImagesRelation($id);
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