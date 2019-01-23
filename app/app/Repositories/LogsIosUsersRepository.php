<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\LogsIosUsers;
use Exception;
use Carbon\Carbon;
use DB;
use App\Entitys\LogEntity;
use Illuminate\Support\Collection;

class LogsIosUsersRepository
{
    private $logsIosUsers;
    private $entity;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LogsIosUsers $logsIosUsers)
    {
        $this->logsIosUsers = $logsIosUsers;
        $this->entity = function (LogsIosUsers $logsIosUsers) {
            $logEntity = new LogEntity($logsIosUsers);

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

        return $this->logsIosUsers::select($select)
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

        return $this->logsIosUsers::select($select)
            ->whereDate('created_at', Carbon::today())
            ->get()
            ->map($this->entity);
    }

    public function store(Request $request): bool
    {
        try{
            $this->logsIosUsers->user_id = $request->user_id;
            $this->logsIosUsers->memo = $request->memo;
            $this->logsIosUsers->language = $request->language;
            $this->logsIosUsers->version = $request->version;
            $this->logsIosUsers->save();

            return true;
        } catch(Exception $e) {
            return false;
        }
    }
}
