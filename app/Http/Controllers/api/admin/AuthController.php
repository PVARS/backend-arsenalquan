<?php


namespace App\Http\Controllers\api\admin;


use App\Http\Controllers\Controller;
use App\Http\Request\User\LoginRequest ;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Exception;

class AuthController extends Controller
{
    /**
     * Auth login
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function auth(LoginRequest $request): JsonResponse
    {
        try {
            $fields = $request->all();

            $user = User::join('role', 'role.id', '=', 'user.role_id')
                ->whereNull('role.deleted_at')
                ->where('role.disabled', false)
                ->whereNull('user.deleted_at')
                ->where('user.disabled', false)
                ->where('user.login_id', '=', $fields['login_id'])
                ->first();
            if (!$user || !Hash::check($fields['password'], $user->password)){
                return $this->unauthorized();
            }
            $token = $user->createToken('token')->plainTextToken;

            return $this->sendInformation(['user_information'=>$user, 'access_token'=>$token]);
        } catch (Exception $exception){
            return $this->sendError500($exception);
        }
    }

    /**
     * Logout & delete token
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();

            return $this->sendMessage('Logged out');
        } catch (Exception $exception){
            return $this->sendError500($exception);
        }
    }
}
