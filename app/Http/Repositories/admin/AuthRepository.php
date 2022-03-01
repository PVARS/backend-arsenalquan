<?php


namespace App\Http\Repositories\admin;


use App\Http\Repositories\Repository;
use App\Models\PersonAccessTokens;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class AuthRepository extends Repository
{
    /**
     * @param $request
     * @return JsonResponse
     */
    public function getUserInfoByUserName($request)
    {
        return User::join('role', 'role.id', '=', 'user.role_id')
            ->whereNull('role.deleted_at')
            ->where('role.disabled', false)
            ->whereNull('user.deleted_at')
            ->where('user.disabled', false)
            ->where('user.login_id', '=', $request['login_id'])
            ->select(
                'user.id',
                'user.login_id',
                'user.password',
                'user.email',
                'user.full_name',
                'user.disabled',
                'user.created_at',
                'user.created_by',
                'role.role_name',
                'role.disabled as role_disable')
            ->first();
    }

    /**
     * @param  mixed $request
     * @return void
     */
    public function getTokenEnableId($userId)
    {
        return PersonAccessTokens::where('tokenable_id', '=', $userId)
            ->select('tokenable_id')
            ->get();
    }

    /**
     * @param  mixed $request
     * @return void
     */
    public function deleteTokenEnableIdById($userId)
    {
        return PersonAccessTokens::where('tokenable_id', '=', $userId)
            ->delete();
    }
}
