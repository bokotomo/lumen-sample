<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserLogsService;
use App\Http\Responders\UserLog\UserLogIndexResponder;

class UserLogController extends Controller
{
    public $headers = ['Content-Type' => 'text/plain'];
    private $userLogsService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        UserLogsService $userLogsService
    ) {
        $this->userLogsService = $userLogsService;
    }

    public function index(
      Request $request,
      UserLogIndexResponder $responder
    ) {
        return response([], 200, $this->headers);
        $this->validate($request, [
            'type' => 'required|max:10',
        ]);

        $logs= $this->userLogsService->getLog($request);

        return $responder($logs);
    }

    public function getLogToday(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|max:10',
        ]);

        $logs= $this->userLogsService->getLogToday($request);
        $res = [
            'logs' => $logs,
        ];

        return response($res, 200, $this->headers);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|max:10',
        ]);

        $isStored = $this->userLogsService->storeLog($request);
        $res = [
            'isStored' => $isStored,
        ];

        return response($res, 200, $this->headers);
    }
}
