<?php

namespace App\Services;

use Illuminate\Http\Response;

class BaseService
{
    public function sendResponse($message = '', array $data = [], $status = Response::HTTP_OK, $success = true)
    {
        return [
            'success' => $success,
            'message' => $message,
            'data' => $data,
            'status' => $status,
        ];
    }

    public function sendError(
        $message = '',
        $status = Response::HTTP_INTERNAL_SERVER_ERROR,
        array $data = [],
        $success = false
    ) {
        return $this->sendResponse($message, $data, $success, $status);
    }
}
