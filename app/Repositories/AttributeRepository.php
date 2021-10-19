<?php

namespace App\Repositories;

use App\Models\Attribute;

class AttributeRepository extends BaseRepository
{
    public function model()
    {
        return Attribute::class;
    }
}
