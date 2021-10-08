<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function getViewLogin()
    {
        return view('admin.auth.login');
    }

    public function doLoginAdmin(SigninRequest $request)
    {
        $response = $this->authService->doLoginAdmin($request->all());
        if ($response['success']) {
            return redirect()->route('admin.dashboard.index')->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }
}
