<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return view('user.cart.index');
    }

    public function add($slug, Request $request)
    {
        $quantity = (int)$request->get('quantity', 1);
        if ($quantity > 100) {
            toast('Chỉ được thêm tối đa 100 sản phẩm', 'error')->autoClose(3000);
            return redirect()->back();
        }
        try {
            if ($quantity < 0) {
                throw new \Exception;
            }
            $product = $this->productRepository->getProductBySlug($slug);
            Cart::add($product->slug, $product->name, $quantity, 200000, 0);
            toast('Đã thêm sản phẩm vào giỏ hàng', 'success')->autoClose(3000);
            return redirect()->back();
        } catch (\Exception $e) {
            toast('Sản phẩm chưa được thêm vào giỏ hàng', 'error')->autoClose(3000);
            return redirect()->back();
        }
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        toast('Đã xóa sản phẩm khỏi giỏ hàng', 'success')->autoClose(3000);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        if (!$request->has('quantity')) {
            toast('Cập nhật giỏ hàng thất bại', 'error')->autoClose(3000);
            return redirect()->back();
        }
        foreach ($request->get('quantity') as $rowId => $qtyItem) {
            Cart::update($rowId, $qtyItem);
        }
        toast('Cập nhật giỏ hàng thành công', 'success')->autoClose(3000);
        return redirect()->back();
    }
}
