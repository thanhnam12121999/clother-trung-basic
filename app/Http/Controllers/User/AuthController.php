<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\Models\Member;
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

    public function signIn()
    {
        return view('user.auth.sign-in');
    }

    public function signUp()
    {
        return view('user.auth.sign-up');
    }

    public function doLogin(SigninRequest $request)
    {
        $execResponse = $this->authService->doLogin($request->validated());
        if ($execResponse['success']) {
            return redirect()->route('home')->with('success', $execResponse['message']);
        }
        alert()->error($execResponse['message']);
        return redirect()->back()->withInput();
    }

    public function doRegister(SignupRequest $request)
    {
        $execResponse = $this->authService->doRegister($request->validated());
        if ($execResponse['success']) {
            return redirect()->route('home')->with('success', $execResponse['message']);
        }
        alert()->error($execResponse['message']);
        return redirect()->back()->withInput();
    }

    public function logout(Request $request)
    {
        if (Auth::guard('accounts')->check() && isAccountType(Member::class)) {
            Auth::guard('accounts')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect()->route('home')->with('toast_success', 'Đăng xuất thành công');
    }
}
