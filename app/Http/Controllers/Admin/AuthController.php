<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Models\Manager;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function logout(Request $request)
    {
        if (isManagerLogged()) {
            Auth::guard('accounts')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect()->route('admin.login-page')->with('success_msg', 'Đăng xuất thành công');
    }
}
