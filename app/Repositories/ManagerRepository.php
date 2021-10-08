<?php

namespace App\Repositories;

use App\Models\Manager;

class ManagerRepository extends BaseRepository
{
    public function model()
    {
        return Manager::class;
    }

    public function getAll()
    {
        return $this->all();
    }
} 