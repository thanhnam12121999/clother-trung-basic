<?php

namespace App\Repositories;

use App\Models\Account;
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
}