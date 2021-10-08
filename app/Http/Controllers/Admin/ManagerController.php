<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateManagerAccountRequest;
use App\Http\Resources\AccountResource;
use App\Repositories\AccountRepository;
use App\Repositories\ManagerRepository;
use App\Services\ManagerService;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    protected $managerRepository;
    protected $accountRepository;
    protected $managerService;

    public function __construct(
        ManagerRepository $managerRepository, 
        AccountRepository $accountRepository,
        ManagerService $managerService
        )
    {
        $this->managerRepository = $managerRepository;
        $this->accountRepository = $accountRepository;
        $this->managerService = $managerService;
    }

    public function index() {
        $listStaffs = AccountResource::collection($this->accountRepository->getAccountManagerIsStaff());
        return view('admin.manager.index', compact('listStaffs'));
    }

    public function getFormEdit(int $id)
    {
        $managers = $this->managerRepository->getAll();
        $account = new AccountResource($this->accountRepository->getAccountManagerById($id));
        return view('admin.manager.edit', compact('managers', 'account'));
    }

    public function update(int $id, UpdateManagerAccountRequest $request)
    {
        $response = $this->managerService->updateAccountOfManager($id, $request);
        if ($response['success']) {
            return redirect()->route('admin.manager.index')->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg','adad');
    }

    public function destroy(int $id)
    {
        $response = $this->managerService->delete($id);
        if ($response['success']) {
            return redirect()->route('admin.manager.index')->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }
}
