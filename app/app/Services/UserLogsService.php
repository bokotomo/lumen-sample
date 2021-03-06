<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\LogsIosUsersRepository;
use App\Repositories\LogsAndroidUsersRepository;

/**
 * ユーザのログを操作
 */
class UserLogsService
{
    private $logsIosUsersRepository;
    private $logsAndroidUsersRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        LogsIosUsersRepository $logsIosUsersRepository,
        LogsAndroidUsersRepository $logsAndroidUsersRepository
    ) {
        $this->logsIosUsersRepository = $logsIosUsersRepository;
        $this->logsAndroidUsersRepository = $logsAndroidUsersRepository;
    }

    public function getLog(Request $request): object
    {
        if ($request->type === 'ios') {
            return $this->logsIosUsersRepository->getAll();
        } elseif ($request->type === 'android') {
            return $this->logsAndroidUsersRepository->getAll();
        }
        return (object)[];
    }

    public function getLogToday(Request $request): object
    {
        if ($request->type === 'ios') {
            return $this->logsIosUsersRepository->getToday();
        } elseif ($request->type === 'android') {
            return $this->logsAndroidUsersRepository->getToday();
        }
        return (object)[];
    }

    public function storeLog(Request $request): bool
    {
        if ($request->type === 'ios') {
            return $this->logsIosUsersRepository->store(
                $request->user_id,
                $request->memo,
                $request->language,
                $request->version,
            );
        } elseif ($request->type === 'android') {
            return $this->logsAndroidUsersRepository->store(
                $request->user_id,
                $request->memo,
                $request->language,
                $request->version,
            );
        }
        return false;
    }
}
