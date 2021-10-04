<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\AttributeRepository;
use App\Repositories\AttributeValueRepository;
use App\Repositories\ProductRepository;
use App\Traits\HandleImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductService extends BaseService
{
    use HandleImage;

    protected $productRepository;
    protected $attributeRepository;
    protected $attributeValueRepository;

    public function __construct(
        ProductRepository $productRepository,
        AttributeRepository $attributeRepository,
        AttributeValueRepository $attributeValueRepository
    ) {
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            $productData = $request->only(['name', 'category_id', 'summary', 'detail', 'description', 'status']);
            $featureImage = $request->file('feature_image');
            $productImages = $request->file('image_list');
            $newNameOfFeatureImage = $this->createImage($featureImage, 'products');
            $listNewNameOfProductImages = $this->createImage($productImages, 'products', true);
            if (!$newNameOfFeatureImage || !$listNewNameOfProductImages) {
                return $this->sendError('Lỗi thêm ảnh sản phẩm, vui lòng thử lại', Response::HTTP_BAD_REQUEST);
            }
            $productData['feature_image'] = $newNameOfFeatureImage;
            $product = $this->productRepository->create($productData);
            if ($product->id) {
                $product->attributes()->sync($request->get('attribute_product', []));
                $product->images()->createMany($listNewNameOfProductImages);
            }
            DB::commit();
            return $this->sendResponse('Sản phẩm đã được thêm thành công.');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại');
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

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $product = $this->productRepository->find($id);
            $productData = $request->only(['name', 'category_id', 'summary', 'detail', 'description', 'status']);
            $oldImagesRelation = $product->images;

            if ($request->hasFile('feature_image')) {
                $response = $this->deleteImage($product->feature_image, 'products');
                if (!$response) {
                    throw new \Exception;
                }
                $featureImage = $request->file('feature_image');
                $newNameOfFeatureImage = $this->createImage($featureImage, 'products');
                if (!$newNameOfFeatureImage) {
                    return $this->sendError('Lỗi thêm ảnh sản phẩm, vui lòng thử lại', Response::HTTP_BAD_REQUEST);
                }
                $productData['feature_image'] = $newNameOfFeatureImage;
            }
            if ($request->hasFile('image_list')) {
                $response = $this->deleteMultipleImages($oldImagesRelation, 'products');
                if (!$response) {
                    throw new \Exception;
                }
                $productImages = $request->file('image_list');
                $listNewNameOfProductImages = $this->createImage($productImages, 'products', true);
                if (!$listNewNameOfProductImages) {
                    return $this->sendError('Lỗi thêm ảnh sản phẩm, vui lòng thử lại', Response::HTTP_BAD_REQUEST);
                }
                $product->images()->delete();
                $product->images()->createMany($listNewNameOfProductImages);
            }
            $this->productRepository->update($id, $productData);
            $product->attributes()->sync($request->get('attribute_product', []));
            DB::commit();
            return $this->sendResponse('Sản phẩm đã được sửa thành công.');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại.');
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $product = $this->productRepository->find($id);
            $featureImage = $product->feature_image;
            $productImages = $product->images;
            $isDelete = $this->deleteImage($featureImage, 'products');
            $isDeleteMultiple = $this->deleteMultipleImages($productImages);
            if (!$isDelete || !$isDeleteMultiple) {
                throw new \Exception;
            }
            $product->images()->delete();
            $product->delete();
            DB::commit();
            return $this->sendResponse('Xóa sản phẩm thành công');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại.');
    }

    public function deleteMultipleProducts($products)
    {
        try {
            foreach ($products as $product) {
                $this->delete($product->id);
            }
            return true;
        } catch (\Exception $e) {
            Log::error($e);
        }
        return false;
    }

    public function createProductAttribute(array $data)
    {
        try {
            DB::beginTransaction();
            $attribute = $this->attributeRepository->create([
                'name' => $data['attr_name']
            ]);
            if ($attribute->id) {
                $attrValuesData = [];
                foreach ($data['attribute_values'] as $attrValue) {
                    array_push($attrValuesData, ['name' => $attrValue]);
                }
                $attribute->attributeValues()->createMany($attrValuesData);
            }
            DB::commit();
            return $this->sendResponse('Tạo thuộc tính thành công');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Tạo thuộc tính thất bại');
    }

    public function updateProductAttribute(array $data, $attribute)
    {
        try {
            DB::beginTransaction();
            tap($attribute)->update([
                'name' => $data['attr_name']
            ]);
            if (!empty($data['attribute_values'])) {
                foreach ($data['attribute_values'] as $id => $attrValue) {
                    $this->attributeValueRepository->update($id, [
                        'name' => $attrValue
                    ]);
                }
            }
            if (!empty($data['new_attribute_values'])) {
                $attrValuesData = [];
                foreach ($data['new_attribute_values'] as $attrValue) {
                    array_push($attrValuesData, ['name' => $attrValue]);
                }
                $attribute->attributeValues()->createMany($attrValuesData);
            }
            $attrValueIdsDelete = json_decode($data['attribute_values_delete']);
            if (!empty($attrValueIdsDelete)) {
                foreach ($attrValueIdsDelete as $id) {
                    $this->attributeValueRepository->delete($id);
                }
            }
            DB::commit();
            return $this->sendResponse('Sửa thuộc tính thành công');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Sửa thuộc tính thất bại');
    }
}
