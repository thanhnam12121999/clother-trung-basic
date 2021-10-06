<?php

if (!function_exists('getLoggedInUser')) {
    function getLoggedInUser()
    {
        return auth()->guard('accounts')->user();
    }
}

if (!function_exists('getAccountInfo')) {
    function getAccountInfo()
    {
        return getLoggedInUser()->accountable;
    }
}

if (!function_exists('isAccountType')) {
    function isAccountType($accountType)
    {
        return getLoggedInUser()->accountable_type == $accountType;
    }
}

if (!function_exists('getCart')) {
    function getCart()
    {
        return \Cart::content();
    }
}

if (!function_exists('getCartTotal')) {
    function getCartTotal()
    {
        return \Cart::subtotal(0, ',', '.');
    }
}

if (!function_exists('getProductImageInCart')) {
    function getProductImageInCart($itemId)
    {
        $product = \App\Models\Product::where('slug', $itemId)->first();
        return $product->feature_image ?? null;
    }
}

if (!function_exists('getCombinations')) {
    function getCombinations($arrays)
    {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }
}
