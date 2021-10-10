<?php

namespace App\Services;

use App\Models\Member;
use App\Repositories\AccountRepository;
use App\Repositories\ManagerRepository;
use App\Repositories\MemberRepository;
use App\Traits\HandleImage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AccountService extends BaseService
{
    use HandleImage;

    protected $accountRepository;
    protected $memberRepository;

    public function __construct(AccountRepository $accountRepository, MemberRepository $memberRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->memberRepository = $memberRepository;
    }

    public function updateAccountOfMember($id, $request)
    {
        try {
            DB::beginTransaction();
            $account = $this->accountRepository->find($id);
            $accountsData = $request->only(['name', 'email', 'username', 'phone_number', 'gender', 'date_of_birth']);
            if ($request->hasFile('avatar')) {
                $response = $this->deleteImage($account->avatar, 'accounts');
                if (!$response) {
                    throw new \Exception;
                }
                $avatarAccount = $request->file('avatar');
                $newNameImage = $this->createImage($avatarAccount, 'accounts');
                if (!$newNameImage) {
                    return $this->sendError('Lỗi thêm ảnh đại diện, vui lòng thử lại', Response::HTTP_BAD_REQUEST);
                }
                $accountsData['avatar'] = $newNameImage;
            }
            $member = $this->memberRepository->create(['address' => $request->address]);
            if($member) {
                $accountsData['accountable_id'] = $member->id;
                $accountsData['accountable_type'] = Member::class;
            }
            $account = $this->accountRepository->update($id, $accountsData);
            
            DB::commit();
            return $this->sendResponse('Sửa thành công.');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Sửa thất bại');
    }
}
