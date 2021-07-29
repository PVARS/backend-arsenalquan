<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Request\User\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Get all user
     *
     * @return JsonResponse
     */
    public function findAll(): JsonResponse
    {
        try {
            $users = User::all()->whereNull('deleted_at');

            return $this->responseData($users);
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Get user by id
     *
     * @param $user
     * @return JsonResponse
     */
    public function getById($user): JsonResponse
    {
        try {
            return $this->responseData(User::findOrFail($user));
        } catch (ModelNotFoundException $exception){
            return $this->sendError500('Không tìm thấy');
        }
    }

    /**
     * Register new user
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function register(UserRequest $request): JsonResponse
    {
        try {
            $fields = $request->all();

            User::create([
                'login_id' => $fields['login_id'],
                'password' => Hash::make($fields['password']),
                'role_id' => $fields['role_id'],
                'email' => $fields['email'],
                'full_name' => $fields['full_name'],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'created_by' => Auth::id()
            ]);

            return $this->sendMessage('Tạo tài khoản thành công');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Update user by id
     *
     * @param UserRequest $request
     * @param $user
     * @return JsonResponse
     */
    public function update(UserRequest $request, $user): JsonResponse
    {
        try {
            try {
                $result = User::findOrFail($user);
            } catch (ModelNotFoundException $exception){
                return $this->sendError500('Không tìm thấy');
            }

            $fields = $request->all();
            if ($result->update([
                'login_id' => $fields['login_id'],
                'password' => Hash::make($fields['password']),
                'role_id' => $fields['role_id'],
                'email' => $fields['email'],
                'full_name' => $fields['full_name'],
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_by' => Auth::id()
            ])){
                return $this->sendMessage('Cập nhật thành công');
            }
        } catch (Exception $exception){
            $this->sendError500();
        }
    }

    /**
     * Disable by id
     *
     * @param $user
     * @return JsonResponse
     */
    public function disable($user): JsonResponse
    {
        try {
            try {
                $result = User::findOrFail($user);
            } catch (ModelNotFoundException $exception){
                return $this->sendError500('Không tìm thấy');
            }

            $status = $result->disabled;
            if ($status == 0) {
                $status = 1;
                $message = 'Khoá thành công';
            } else {
                $status = 0;
                $message = 'Mở khoá thành công';
            }

            if ($result->update(['disabled' => $status]))
                return $this->sendMessage($message);
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }
}
