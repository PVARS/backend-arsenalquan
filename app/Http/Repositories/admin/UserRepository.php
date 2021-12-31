<?php


namespace App\Http\Repositories\admin;


use App\Http\Repositories\Repository;
use App\Models\User;

class UserRepository extends Repository
{
    /**
     * @return mixed
     */
    public function list()
    {
        return User::join('role', 'role.id', '=', 'user.role_id')
            ->whereNull('role.deleted_at')
            ->whereNull('user.deleted_at')
            ->orderby('role.disabled', 'asc')
            ->orderby('user.role_id', 'asc')
            ->orderby('user.disabled', 'asc')
            ->orderby('user.created_at', 'asc')
            ->select(
                'user.id',
                'user.login_id',
                'user.email',
                'user.full_name',
                'user.disabled',
                'user.created_at',
                'role.role_name',
                'role.disabled as role_disable')
            ->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return User::join('role', 'role.id', '=', 'user.role_id')
            ->where('user.id', $id)
            ->whereNull('role.deleted_at')
            ->whereNull('user.deleted_at')
            ->select(
                'user.id',
                'user.login_id',
                'user.email',
                'user.full_name',
                'user.disabled',
                'user.created_at',
                'role.role_name',
                'role.disabled as role_disable')
            ->first();
    }

    /**
     * @param $role
     * @return mixed
     */
    public function findFullUserByRole($role)
    {
        return User::where('role_id', $role)->get();
    }

    public function userFindOrFail($id)
    {
        return User::findOrFail($id);
    }

    /**
     * @return mixed
     */
    public function recycleBin()
    {
        return User::join('role', 'user.role_id', '=', 'role.id')
            ->whereNotNull('user.deleted_at')
            ->whereNull('role.deleted_at')
            ->orderby('user.deleted_at', 'desc')
            ->select(
                'user.id',
                'user.login_id',
                'user.email',
                'user.full_name',
                'user.disabled',
                'user.created_at',
                'user.deleted_at',
                'role.role_name',
                'role.disabled as role_disable')
            ->get();
    }

    /**
     * @param array $input
     */
    public function register(array $input)
    {
        User::create($input);
    }

    /**
     * @param array $input
     * @param $id
     */
    public function update(array $input, $id)
    {
        User::join('role', 'role.id', '=', 'user.role_id')
            ->whereNull('role.deleted_at')
            ->where('role.disabled', false)
            ->whereNull('user.deleted_at')
            ->where('user.disabled', false)
            ->where('user.id', $id)
            ->update($input);
    }

    /**
     * @param array $input
     * @param $id
     */
    public function disable(array $input, $id)
    {
        User::join('role', 'role.id', '=', 'user.role_id')
            ->where('user.id', $id)
            ->whereNull('user.deleted_at')
            ->update($input);
    }

    /**
     * @param array $input
     * @param $id
     */
    public function delete(array $input, $id)
    {
        User::join('role', 'role.id', '=', 'user.role_id')
            ->whereNull('role.deleted_at')
            ->where('role.disabled', false)
            ->whereNull('user.deleted_at')
            ->where('user.id', $id)
            ->update($input);
    }

    /**
     * @param array $input
     * @param $id
     */
    public function restore(array $input, $id)
    {
        User::whereNotNull('deleted_at')
            ->where('id', $id)
            ->update($input);
    }
}
