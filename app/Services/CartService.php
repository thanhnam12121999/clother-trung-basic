<?php

namespace App\Services;

use App\Models\Member;
use App\Repositories\AttributeValueRepository;
use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartService extends BaseService
{
    protected $productRepository;
    protected $attributeValueRepository;
    protected $cartRepository;

    public function __construct(
        ProductRepository $productRepository,
        AttributeValueRepository $attributeValueRepository,
        CartRepository $cartRepository
    ) {
        $this->productRepository = $productRepository;
        $this->attributeValueRepository = $attributeValueRepository;
        $this->cartRepository = $cartRepository;
    }

    public function addCart($slug, array $data)
    {
        try {
            if (isMemberLogged()) {
                $item = $this->cartRepository->getCartItem();
                if (!empty($item)) {
                    $item->delete();
                }
            }
            $product = $this->productRepository->getProductBySlug($slug);
            $attributes = $this->attributeValueRepository->getAttributeValuesOfProduct($data['attributes']);
            $attributes = $attributes->mapWithKeys(function ($attrValue) {
                return [$attrValue->attribute->name => $attrValue->name];
            })->all();
            $price = (int)str_replace(".","",$data['variant_price']);
            Cart::add([
                'id' => $slug . '-' . $data['variant_id'],
                'name' => $product->name,
                'qty' => $data['quantity'],
                'price' => $price,
                'weight' => 0,
                'options' => [
                    'product_id' => $product->id,
                    'attributes' => $attributes,
                    'slug' => $slug,
                    'variant_id' => $data['variant_id']
                ]

            ]);
            if (isMemberLogged()) {
                $subtotal = (int)str_replace(".","",Cart::subtotal(0, ',', '.'));
                $this->cartRepository->create([
                    'identifier' => getAccountInfo()->id,
                    'instance' => 'default',
                    'content' => Cart::content()->toJson(),
                    'sub_total' => $subtotal
                ]);
            }
            return $this->sendResponse('Đã thêm sản phẩm vào giỏ hàng');
        } catch (\Exception $e) {
            Log::error($e);
        }
        return $this->sendError('Sản phẩm chưa được thêm vào giỏ hàng');
    }

    public function deleteCartItem($rowId)
    {
        try {
            DB::beginTransaction();
            if (isMemberLogged()) {
                $cartContent = getCart();
                unset($cartContent[$rowId]);
                $cartInstance = $this->cartRepository->getCartByMember(getAccountInfo()->id);
                $subtotal = (int)str_replace(".","",Cart::subtotal(0, ',', '.'));
                tap($cartInstance)->update([
                    'content' => json_encode($cartContent),
                    'sub_total' => $subtotal
                ]);
            } else {
                Cart::remove($rowId);
            }
            DB::commit();
            return $this->sendResponse('Đã xóa sản phẩm khỏi giỏ hàng');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại');
    }

    public function updateCart($quantity)
    {
        try {
            DB::beginTransaction();
            if (isMemberLogged()) {
                $cartContent = getCart();
                foreach ($quantity as $rowId => $qtyItem) {
                    $cartContent[$rowId]['qty'] = $qtyItem;
                }
                $cartInstance = $this->cartRepository->getCartByMember(getAccountInfo()->id);
                $subtotal = (int)str_replace(".","",Cart::subtotal(0, ',', '.'));
                tap($cartInstance)->update([
                    'content' => json_encode($cartContent),
                    'sub_total' => $subtotal
                ]);
            } else {
                foreach ($quantity as $rowId => $qtyItem) {
                    Cart::update($rowId, $qtyItem);
                }
            }
            DB::commit();
            return $this->sendResponse('Cập nhật giỏ hàng thành công');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại');
    }
}
