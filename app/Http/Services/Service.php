<?php


namespace App\Http\Services;


use App\Http\Repositories\Repository;

class Service
{
    const ACCESS_ADMIN = 'access-admin';
    const ACCESS_ADMIN_SYS = 'access-admin-system';

    /**
     * Get id max
     *
     * @param $table
     * @return int|mixed
     */
    public function getIdMax($table){
        $repository = new Repository();

        $idMax = $repository->getMaxId($table);
        if ($idMax == null) {
            $id = 1;
        } else {
            $id = $idMax + 1;
        }

        return $id;
    }
}
