<?php


namespace App\Http\Repositories;


use Illuminate\Support\Facades\DB;

class Repository
{
    public function getMaxId($table)
    {
        return DB::table($table)->max('id');
    }
}
