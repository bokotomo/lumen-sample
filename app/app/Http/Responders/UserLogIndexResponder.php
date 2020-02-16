<?php

namespace App\Http\Responders\UserLog;

//use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserLogIndexResponder
{
    /**
     * @param array
     * @return JsonResponse
     */
    public function __invoke()
    {
        return 1;
        // return response([
        //     'logs' => $logs
        // ], 200, $this->headers);
    }
}
