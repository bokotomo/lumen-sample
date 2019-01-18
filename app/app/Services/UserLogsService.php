<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;

class UserLogService
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //
    public function storeLog(Request $request): bool
    {
        $type = $request->type;

        if ($type === 'ios')
        {
            return true;
        } elseif ($type=== 'android') {
            return true;
        } else {
            return false;
        }
    }
}
