<?php

if (!function_exists('getLoggedInUser')) {
    function getLoggedInUser()
    {
        return auth()->guard('accounts')->user();
    }
}

if (!function_exists('authCheck')) {
    function authCheck()
    {
        return auth()->guard('accounts')->check();
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

if (!function_exists('isMemberLogged')) {
    function isMemberLogged()
    {
        return authCheck() && isAccountType(\App\Models\Member::class);
    }
}

if (!function_exists('getCart')) {
    function getCart()
    {
        return isMemberLogged()
            ? (getAccountInfo()->cart ? getAccountInfo()->cart->cart_content : [])
            : collect(\Cart::content()->all(), function ($item) {
                return collect($item)->toArray();
            })->toArray();
    }
}

if (!function_exists('getCartTotal')) {
    function getCartTotal()
    {
        return isMemberLogged() ? number_format(getAccountInfo()->cart->sub_total, 0, ',', '.') ?? 0 : \Cart::subtotal(0, ',', '.');
    }
}

if (!function_exists('getProductImageInCart')) {
    function getProductImageInCart($slug)
    {
        $product = \App\Models\Product::where('slug', $slug)->first();
        return $product->feature_image_path ?? null;
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
