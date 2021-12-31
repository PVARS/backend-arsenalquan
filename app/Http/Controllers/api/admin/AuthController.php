<?php


namespace App\Http\Controllers\api\admin;


use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Request\User\LoginRequest ;
use App\Http\Services\admin\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Auth login
     *
     * @param LoginRequest $request
     * @param AuthService $service
     * @return JsonResponse
     * @throws ApiException
     */
    public function auth(LoginRequest $request, AuthService $service): JsonResponse
    {
        $fields = $request->all();

        $data = $service->handleAuth($fields);

        return $this->success($data);
    }

    /**
     * Logout & delete token
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();
        $this->message = 'Đã đăng xuất.';

        return $this->success();
    }
}
