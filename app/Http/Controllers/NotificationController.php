<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function markAtRead(Notification $notification)
    {
        try {
            if (empty($notification->read_at)) {
                tap($notification)->update([
                    'read_at' => Carbon::now()
                ]);
            }
            return response()->json(['status' => true]);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['status' => false]);
        }
    }
}
