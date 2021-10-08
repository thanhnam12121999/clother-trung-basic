<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\AttributeRepository;
use App\Repositories\AttributeValueRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProductVariantRepository;
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
    protected $productVariantService;
    protected $productVariantRepository;

    public function __construct(
        ProductRepository $productRepository,
        ProductVariantService $productVariantService,
        ProductVariantRepository $productVariantRepository
    ) {
        $this->productRepository = $productRepository;
        $this->productVariantService = $productVariantService;
        $this->productVariantRepository = $productVariantRepository;
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
                $productAttributes = $request->get('attribute_product', []);
                $product->attributes()->sync($productAttributes);
                $variants = $this->productVariantService->getProductVariantsValue($productAttributes);
                $product->variants()->createMany($variants);
                $product->images()->createMany($listNewNameOfProductImages);
            }
            DB::commit();
            return $this->sendResponse('Sản phẩm đã được thêm thành công.', [
                'product' => $product
            ]);
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
            $productAttributes = $request->get('attribute_product', []);
            $product->attributes()->sync($productAttributes);
            $this->handleUpdateVariants($product, $productAttributes);
            DB::commit();
            return $this->sendResponse('Sản phẩm đã được sửa thành công.');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại.');
    }

    private function handleUpdateVariants($product, $productAttributes)
    {
        $variantsData = $this->productVariantService->getProductVariantsValue($productAttributes);
        $variants = $this->productVariantRepository->getVariantsByProductId($product->id);
        $variantsWithId = $variants->mapWithKeys(function ($variantModel) {
            return [$variantModel->id => $variantModel->variant];
        });

        $variantsData = collect($variantsData)->map(function ($variant) {
            return $variant['variant'];
        });

        $variantsMapping = $variantsWithId->map(function ($variantValue) {
            return json_encode(json_decode($variantValue, true));
        });

        $sameVariants = array_intersect($variantsData->all(), $variantsMapping->all());
        $variantsDataFinal = $variantsData->filter(function ($variantValue) use ($sameVariants) {
            return !in_array($variantValue, $sameVariants);
        })->map(function ($variantValue) {
            return ['variant' => $variantValue];
        });

        $variantsDelete = $variantsMapping->filter(function ($variantValue) use ($sameVariants) {
            return !in_array($variantValue, $sameVariants);
        });

        $product->variants()->createMany($variantsDataFinal->toArray());

        $variantsDelete->each(function ($variantValue, $variantId) {
            $this->productVariantRepository->delete($variantId);
        });
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
}
