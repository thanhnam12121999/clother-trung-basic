<?php

namespace App\View\Composers;

use App\Repositories\CategoryRepository;
use App\Repositories\NotificationRepository;
use Illuminate\View\View;

class MultiComposer
{
    protected $categoryRepository;
    protected $notificationRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        NotificationRepository $notificationRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function compose(View $view)
    {
        $categories = $this->categoryRepository->all();
        $notifications = $this->notificationRepository->getAll();

        $adminNoti = $notifications->filter(function ($noti) {
            return $noti->for_admin;
        });
        $unreadAdminNoti = $adminNoti->filter(function ($noti) {
            return empty($noti->read_at);
        });

        $data = [
            'categories' => $categories,
            'adminNoti' => $adminNoti,
            'unreadAdminNoti' => $unreadAdminNoti,
        ];

        if (isMemberLogged()) {
            $memberNotifies = $this->notificationRepository->getMemberNotifies();
            $unreadMemberNoti = $memberNotifies->filter(function ($noti) {
                return empty($noti->read_at);
            });
            $data['memberNotifies'] = $memberNotifies;
            $data['unreadMemberNoti'] = $unreadMemberNoti;
        }

        $view->with($data);
    }
}
