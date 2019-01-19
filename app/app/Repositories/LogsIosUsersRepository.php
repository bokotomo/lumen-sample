<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\LogsIosUsers;
use Exception;
use Carbon\Carbon;
use DB;

class LogsIosUsersRepository
{
    private $logsIosUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LogsIosUsers $logsIosUsers)
    {
        $this->logsIosUsers = $logsIosUsers;
    }

    public function getAll(): object
    {
        $select = [
            'user_id',
            'memo',
            'version',
            'language',
            DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d %H-%i-%s") as date')
        ];

        return $this->logsIosUsers::select($select)->get();
    }

    public function getToday(): object
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
            ->get();
    }

    public function store(Request $request): object
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
