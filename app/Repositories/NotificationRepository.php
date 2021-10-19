<?php

namespace App\Repositories;

use App\Models\Account;
use App\Models\Notification;

class NotificationRepository extends BaseRepository
{
    public function model()
    {
        return Notification::class;
    }

    public function getAll()
    {
        return $this->model->orderBy('created_at', 'DESC')->get();
    }

    public function getMemberNotifies()
    {
        return $this->model->where('notifiable_id', getLoggedInUser()->id)
            ->where('notifiable_type', Account::class)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }
}
