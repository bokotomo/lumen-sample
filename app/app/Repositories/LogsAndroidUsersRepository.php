<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\LogsAndroidUsers;
use Exception;
use Carbon\Carbon;
use DB;

class LogsAndroidUsersRepository
{
    private $logsAndroidUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LogsAndroidUsers $logsAndroidUsers)
    {
        $this->logsAndroidUsers = $logsAndroidUsers;
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

        return $this->logsAndroidUsers::select($select)->get();
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

        return $this->logsAndroidUsers::select($select)
            ->whereDate('created_at', Carbon::today())
            ->get();
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
