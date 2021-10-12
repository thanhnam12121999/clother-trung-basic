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
        $variantsValue = $attributeValues->mapToGroups(function ($attrValue, $key) {
            return [
                $attrValue->attribute_id => $attrValue->id
            ];
        })->map(function ($attrValues, $attrId) {
            return $attrValues->all();
        })->all();
        $variantsText = $attributeValues->mapToGroups(function ($attrValue, $key) {
            return [
                $attrValue->attribute_id => $attrValue->name
            ];
        })->map(function ($attrValues, $attrId) {
            return $attrValues->all();
        })->all();

        $variantsValue = getCombinations($variantsValue);
        $variantsText = getCombinations($variantsText);

        $variantsValueMapping = collect($variantsValue)->map(function ($value) {
            return ['variant_value' => json_encode($value)];
        })->all();
        $variantsTextMapping = collect($variantsText)->map(function ($text) {
            return ['variant_text' => implode("-", $text)];
        })->all();

        $variants = [];
        foreach ($variantsValueMapping as $keyValue => $value) {
            foreach ($variantsTextMapping as $keyText => $text) {
                if ($keyValue == $keyText) {
                    array_push($variants, array_merge($value, $text));
                }
            }
        }

        return $variants;
    }

    public function getVariantsOfProduct($product)
    {
        $variants = $product->variants;
        $variantsMapping = $variants->mapWithKeys(function ($variant) {
            return [
                $variant->id => [
                    'variant_text' => $variant->variant_text,
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

    public function handleVariantPrice($data)
    {
        $variantData = collect($data['variant'])->map(function ($item) {
            return (int)$item['attr_value_id'];
        })->all();
        // dd($variantData);
        $variants = $this->productVariantRepository->getVariantsByProductId($data['product_id']);
        $variantsMapping = $variants->mapWithKeys(function ($variant) {
            return [
                $variant->id => [
                    'variant_value' => json_decode($variant->variant_value, true),
                    'variant_text' => $variant->variant_text,
                    'variant_price' => $variant->unit_price,
                    'variant_amount' => $variant->amount
                ]
            ];
        });
        $variantResponse = $variantsMapping->map(function ($item, $variantId) use ($variantData) {
            $diff = collect(array_values($item['variant_value']))->diff($variantData);
            if ($diff->isEmpty()) {
                return [
                    'variant_id' => $variantId,
                    'variant_price' => number_format($item['variant_price'], 0, ",", "."),
                    'variant_amount' => $item['variant_amount']
                ];
            }
            return null;
        })->reject(function ($item) {
            return $item == null;
        })->all();
        return array_values($variantResponse)[0];
    }
}
