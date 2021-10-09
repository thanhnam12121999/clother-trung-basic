<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Manager;
use App\Models\Member;

class AccountRepository extends BaseRepository
{
    
    /**
     * @inheritDoc
     */
    public function model()
    {
        return Account::class;
    }

    public function getAccountMemberByEmail($email)
    {
        return $this->model->where('email', $email)
            ->where('accountable_type', Member::class)
            ->first();
    }

    public function getAccountManagerIsStaff()
    {
        return $this->model->where('accountable_type', Manager::class)->get();
    }

    public function getAccountManagerById($id)
    {
        return $this->find($id);
    }
    
}