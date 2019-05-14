<?php

namespace App\Http\Responders\UserLogs;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserLogIndexResponder
{
    /**
     * @param array
     * @return JsonResponse
     */
    public function __invoke(array $logs): JsonResponse
    {
        return response([
            'logs' => $logs
        ], 200, $this->headers);
    }
}
