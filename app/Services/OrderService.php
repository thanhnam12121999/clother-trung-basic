<?php

namespace App\Services;

use App\Repositories\AttributeValueRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OrderService extends BaseService
{
    protected $attrValueRepository;

    public function __construct(AttributeValueRepository $attrValueRepository)
    {
        $this->attrValueRepository = $attrValueRepository;
    }
}
