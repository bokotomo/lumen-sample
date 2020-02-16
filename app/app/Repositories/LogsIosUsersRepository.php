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

    public function store(int $userId, string $memo, string $language, string $version): bool
    {
        try{
            $this->logsIosUsers->user_id = $userId;
            $this->logsIosUsers->memo = $memo;
            $this->logsIosUsers->language = $language;
            $this->logsIosUsers->version = $version;
            $this->logsIosUsers->save();
            return true;
        } catch(Exception $e) {
            return false;
        }
    }
}
