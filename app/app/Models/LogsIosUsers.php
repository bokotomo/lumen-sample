<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogsIosUsers extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'memo', 'version', 'language'
    ];
}
