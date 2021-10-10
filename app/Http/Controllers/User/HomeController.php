<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMemberAccountRequest;
use App\Services\AccountService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $accountService;

    public function __construct(AccountService $accountService) {
        $this->accountService = $accountService;
    }

    public function index()
    {
        return view('user.home.index');
    }

    public function getProfileUser()
    {
        return view('user.home.profile');
    }

    public function updateProfile(int $id, UpdateMemberAccountRequest  $request)
    {
        $response = $this->accountService->updateAccountOfMember($id, $request);
        if ($response['success']) {
            return redirect()->back()->with('success', $response['message']);
        }
        return redirect()->back()->with('error', $response['message']);
    }
}
