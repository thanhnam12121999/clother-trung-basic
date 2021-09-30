<?php

namespace App\Services;

use App\Models\Member;
use App\Repositories\AccountRepository;
use App\Repositories\MemberRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService extends BaseService
{
    protected $memberRepository;
    protected $accountRepository;

    public function __construct(MemberRepository $memberRepository, AccountRepository $accountRepository)
    {
        $this->memberRepository = $memberRepository;
        $this->accountRepository = $accountRepository;
    }

    public function doLogin(array $data)
    {
        try {
            DB::beginTransaction();
            $fieldType = filter_var($data['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $credentials = [
                $fieldType => $data['username'],
                'password' => $data['password'],
                'accountable_type' => Member::class
            ];
            $isLogin = Auth::guard('accounts')->attempt($credentials);
            if ($isLogin) {
                return $this->sendResponse('Đăng nhập thành công');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return $this->sendError('Đăng nhập thất bại', Response::HTTP_BAD_REQUEST);
    }

    public function doRegister(array $data)
    {
        try {
            DB::beginTransaction();
            $checkEmailExist = $this->accountRepository->getAccountMemberByEmail($data['email']);
            if (!empty($checkEmailExist)) {
                return $this->sendError('Email đã được đăng ký. Bạn vui lòng sử dụng email khác', Response::HTTP_BAD_REQUEST);
            }
            $member = $this->memberRepository->create(['address' => '']);
            $accountData = array_merge($data, [
                'accountable_id' => $member->id,
                'accountable_type' => Member::class
            ]);
            $this->accountRepository->create($accountData);
            DB::commit();
            return $this->sendResponse('Đăng ký thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return $this->sendError('Đăng ký thất bại', Response::HTTP_BAD_REQUEST);
    }
}