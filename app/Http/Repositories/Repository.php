<?php


namespace App\Http\Repositories;


use Illuminate\Support\Facades\DB;

class Repository
{
    const TIME_FROM = ' 00:00:00';

    const TIME_TO = ' 23:59:59';

    public function getMaxId($table)
    {
        return DB::table($table)->max('id');
    }
}
