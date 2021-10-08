<?php

namespace App\Services;

use App\Repositories\AttributeRepository;
use App\Repositories\AttributeValueRepository;
use App\Repositories\ProductVariantRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductAttributeService extends BaseService
{
    protected $attributeRepository;
    protected $attributeValueRepository;

    public function __construct(AttributeRepository $attributeRepository, AttributeValueRepository $attributeValueRepository)
    {
        $this->attributeRepository = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
    }

    public function createAttribute(array $data)
    {
        try {
            DB::beginTransaction();
            $attribute = $this->attributeRepository->create([
                'name' => $data['attr_name']
            ]);
            if ($attribute->id) {
                $attrValuesData = collect($data['attribute_values'])->map(function ($attrValue) {
                    return ['name' => $attrValue];
                });
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

    public function updateAttribute(Request $request, $attribute)
    {
        try {
            DB::beginTransaction();
            tap($attribute)->update([
                'name' => $request->get('attr_name')
            ]);
            foreach ($request->get('attribute_values') as $id => $attrValue) {
                $this->attributeValueRepository->update($id, [
                    'name' => $attrValue
                ]);
            }
            if ($request->has('new_attribute_values')) {
                $attrValuesData = collect($request->get('new_attribute_values'))->map(function ($attrValue) {
                    return ['name' => $attrValue];
                });
                $attribute->attributeValues()->createMany($attrValuesData);
            }
            if ($request->has('attribute_values_delete') && !empty($request->get('attribute_values_delete'))) {
                $attrValueIdsDelete = json_decode($request->get('attribute_values_delete'), true);
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
