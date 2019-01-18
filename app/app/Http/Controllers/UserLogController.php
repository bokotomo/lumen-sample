<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserLogService;

class UserLogController extends Controller
{
    public $headers = ['Content-Type' => 'text/plain'];
    private $userLogService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserLogService $userLogService
    ) {
        //
        $this->userLogService = $userLogService;
    }

    //
    public function store(Request $request)
    {
        $isStored = $this->userLogService->storeLog($request);
        $res = [
            'status' => $isStored
        ];
        return response($res, 200, $this->headers);
    }
}
