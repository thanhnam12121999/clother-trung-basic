<?php

namespace App\Repositories;

use App\Models\Member;

class MemberRepository extends BaseRepository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return Member::class;
    }
}