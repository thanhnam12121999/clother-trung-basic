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
    function isAccountType($accountType) {
        return getLoggedInUser()->accountable_type == $accountType;
    }
}