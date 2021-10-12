<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\MemberRepository;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function index() {
        $members = $this->memberRepository->all();
        return view('admin.member.index', compact('members'));
    }
}
