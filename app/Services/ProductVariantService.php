<?php

namespace App\Services;

use App\Repositories\AttributeValueRepository;
use App\Repositories\ProductVariantRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductVariantService extends BaseService
{
    protected $productVariantRepository;
    protected $attributeValueRepository;

    public function __construct(
        ProductVariantRepository $productVariantRepository,
        AttributeValueRepository $attributeValueRepository
    ) {
        $this->productVariantRepository = $productVariantRepository;
        $this->attributeValueRepository = $attributeValueRepository;
    }

    public function getProductVariantsValue($productAttributes)
    {
        $attributeValues = $this->attributeValueRepository->getAttributeValuesOfProduct($productAttributes);
        $attributeValuesMapping = $attributeValues->mapToGroups(function ($attrValue, $key) {
            return [
                $attrValue->attribute_id => $attrValue->id
            ];
        })->map(function ($attrValues, $attrId) {
            return $attrValues->all();
        })->all();
        $productVariants = getCombinations($attributeValuesMapping);
        $productVariantsMapping = collect($productVariants)->map(function ($variant) {
            return ['variant' => json_encode($variant)];
        })->all();
        return $productVariantsMapping;
    }

    public function getVariantsOfProduct($product)
    {
        $variants = $product->variants;
        $variantsMapping = $variants->mapWithKeys(function ($variant) {
            $attributeValues = $this->attributeValueRepository->getAttributeValuesOfProduct(json_decode($variant->variant));
            $variants = $attributeValues->sortBy('attribute_id')->pluck('name')->map(function ($value) {
                return Str::ucfirst($value);
            });
            return [
                $variant->id => [
                    'variant' => $variants->toArray(),
                    'amount' => $variant->amount,
                    'unit_price' => $variant->unit_price,
                ]
            ];
        });
        return $variantsMapping;
    }

    public function updateProductVariants($product, array $data)
    {
        try {
            DB::beginTransaction();
            collect($data['amount'])->each(function ($value, $key) {
                $this->productVariantRepository->update($key, [
                    'amount' => $value
                ]);
            });
            collect($data['unit_price'])->each(function ($value, $key) {
                $this->productVariantRepository->update($key, [
                    'unit_price' => $value
                ]);
            });
            DB::commit();
            return $this->sendResponse('Cập nhật biến thể thành công');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Cập nhật biến thể thất bại');
    }
}
