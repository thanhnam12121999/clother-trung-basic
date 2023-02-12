<?php

namespace App\Services;

use App\Repositories\OrderDetailRepository;

class OrderDetailService extends BaseService
{
    protected $orderDetailRepository;

    public function __construct(
        OrderDetailRepository $orderDetailRepository
    ) {
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function getOrderByVariantId($varisantId)
    {
        return $this->orderDetailRepository->getOrderByVariantId($varisantId);
    }
}