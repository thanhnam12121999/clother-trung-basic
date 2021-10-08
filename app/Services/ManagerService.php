<?php

namespace App\Services;

use App\Models\Account;
use App\Repositories\AccountRepository;
use App\Repositories\ManagerRepository;
use App\Traits\HandleImage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; 

class ManagerService extends BaseService
{
    use HandleImage;

    protected $managerRepository;
    protected $accountRepository;

    public function __construct(ManagerRepository $managerRepository, AccountRepository $accountRepository)
    {
        $this->managerRepository = $managerRepository;
        $this->accountRepository = $accountRepository;
    }

    public function updateAccountOfManager($id, $request)
    {
        try {
            DB::beginTransaction();
            $account = $this->accountRepository->find($id);
            $accountsData = $request->only(['name', 'email', 'username', 'number_phone', 'gender', 'date_of_birth']);
            if ($request->hasFile('avatar')) {
                $response = $this->deleteImage($account->avatar, 'accounts');
                if (!$response) {
                    throw new \Exception;
                }
                $avatarAccount = $request->file('avatar');
                $newNameImage = $this->createImage($avatarAccount, 'accounts');
                if (!$newNameImage) {
                    return $this->sendError('Lỗi thêm ảnh sản phẩm, vui lòng thử lại', Response::HTTP_BAD_REQUEST);
                }
                $accountsData['avatar'] = $newNameImage;
            }
            $this->accountRepository->update($id, $accountsData);
            DB::commit();
            return $this->sendResponse('Sửa thành công.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
        }
        return $this->sendError('Sửa thất bại');
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $account = $this->accountRepository->find($id);
            $resultDelete = $this->accountRepository->delete($id);
            if(!$resultDelete) {
                throw new \Exception;
            }
            $isDelete = $this->deleteImage($account->avatar, 'accounts');
            if (!$isDelete) {
                throw new \Exception;
            }
            DB::commit();
            return $this->sendResponse('Xóa thành công.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
        }
        return $this->sendError('Xóa thất bại');
    }
}