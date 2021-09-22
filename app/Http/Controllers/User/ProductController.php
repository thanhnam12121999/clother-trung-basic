<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('user.products.list.index');
    }

    public function detail()
    {
        return view('user.products.detail.index');
    }
}
