<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\LogsAndroidUsers;
use Exception;
use Carbon\Carbon;
use DB;
use App\Entitys\LogEntity;
use Illuminate\Support\Collection;


class LogsAndroidUsersRepository
{
    private $logsAndroidUsers;
    private $entity;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LogsAndroidUsers $logsAndroidUsers)
    {
        $this->logsAndroidUsers = $logsAndroidUsers;
        $this->entity = function (LogsAndroidUsers $logsAndroidUsers) {
            $logEntity = new LogEntity($logsAndroidUsers);

            return [
              'user_id' => $logEntity->getUserId(),
              'memo' => $logEntity->getMemo(),
              'version' => $logEntity->getVersion(),
              'language' => $logEntity->getLanguage(),
              'date' => $logEntity->getDate(),
            ];
        };
    }

    public function getAll(): Collection
    {
        $select = [
            'user_id',
            'memo',
            'version',
            'language',
            DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d %H-%i-%s") as date')
        ];

        return $this->logsAndroidUsers::select($select)
            ->get()
            ->map($this->entity);
    }

    public function getToday(): Collection
    {
        $select = [
            'user_id',
            'memo',
            'version',
            'language',
            DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d %H-%i-%s") as date')
        ];

        return $this->logsAndroidUsers::select($select)
            ->whereDate('created_at', Carbon::today())
            ->get()
            ->map($this->entity);
    }

    public function store(Request $request): bool
    {
        try{
            $this->logsAndroidUsers->user_id = $request->user_id;
            $this->logsAndroidUsers->memo = $request->memo;
            $this->logsAndroidUsers->language = $request->language;
            $this->logsAndroidUsers->version = $request->version;
            $this->logsAndroidUsers->save();

            return true;
        } catch(Exception $e) {
            return false;
        }
    }
}
