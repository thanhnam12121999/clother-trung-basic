<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMemberAccountRequest;
use App\Services\AccountService;
use App\Services\SlideService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $accountService;
    protected $slideService;

    public function __construct(AccountService $accountService, SlideService $slideService) {
        $this->accountService = $accountService;
        $this->slideService = $slideService;
    }

    public function index()
    {
        $slides = $this->slideService->getSlideToShow($limit = 4);
        return view('user.home.index', compact('slides'));
    }

    public function getProfileUser()
    {
        if (!isMemberLogged()) {
            return redirect()->route('home');
        }
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
