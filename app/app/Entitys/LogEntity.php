<?php

namespace App\Entitys;

class LogEntity
{
    private $logsUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($logsUsers)
    {
        $this->logsUsers = $logsUsers;
    }

    public function getUserId(): int
    {
        return (int)$this->logsUsers->user_id;
    }

    public function getMemo(): string
    {
        return $this->logsUsers->memo;
    }

    public function getVersion(): string
    {
        return $this->logsUsers->version;
    }

    public function getLanguage(): string
    {
        return $this->logsUsers->language;
    }

    public function getDate(): string
    {
        return (string)$this->logsUsers->date;
    }
}
