<?php


namespace App\Http\Services\admin;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Repositories\admin\AuthRepository;
use App\Http\Resources\admin\user\UserGetAllResource;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthService extends Controller
{
    /**
     * Handle login request
     *
     * @param $request
     * @return array|JsonResponse
     * @throws ApiException
     */
    public function handleAuth($request)
    {
        try {
            $repository = new AuthRepository();
            $user = $repository->getUserInfoByUserName($request);

            if ($user) {
                $personToken = $repository->getTokenEnableId($user->id);

                if (!$personToken->isEmpty()) {
                    $repository->deleteTokenEnableIdById($user->id);
                }
            }
        } catch (Exception $e) {
            throw new ApiException('AQ-0000');
        }

        if (!$user || !Hash::check($request['password'], $user->password)) {
            throw new ApiException('AQ-0001', 200);
        }

        $token = $user->createToken($user->role_name)->plainTextToken;

        return [
            'user_information' => new UserGetAllResource($user),
            'access_token' => $token,
            'expire_date' => Carbon::now()->modify('+1 day')->format('d-m-Y H:i:s')
        ];
    }
}
