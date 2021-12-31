<?php


namespace App\Http\Repositories\admin;


use App\Http\Repositories\Repository;
use App\Models\Role;

class RoleRepository extends Repository
{
    /**
     * @return mixed
     */
    public function list()
    {
        return Role::whereNull('deleted_at')
            ->orderby('id', 'asc')
            ->orderby('disabled', 'asc')
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return Role::whereNull('deleted_at')
            ->where('id', $id)
            ->orderby('id', 'asc')
            ->orderby('disabled', 'asc')
            ->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function roleFindOrFail($id)
    {
        return Role::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function recycleBin()
    {
        return Role::whereNotNull('deleted_at')
            ->orderby('deleted_at', 'desc')
            ->get();
    }

    /**
     * @param array $input
     */
    public function create(array $input)
    {
        Role::create($input);
    }

    /**
     * @param array $input
     * @param $id
     */
    public function update(array $input, $id)
    {
        Role::where('id', $id)->update($input);
    }

    /**
     * Role: Delete & disable
     *
     * @param array $input
     * @param $id
     */
    public function delete(array $input, $id)
    {
        Role::whereNull('deleted_at')
            ->where('id', $id)
            ->update($input);
    }

    /**
     * Restore role
     *
     * @param array $input
     * @param $id
     */
    public function restore(array $input, $id)
    {
        Role::whereNotNull('deleted_at')
            ->where('id', $id)
            ->update($input);
    }
}
