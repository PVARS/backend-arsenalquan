<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Http\Request\User\UserRequest;
use App\Http\Resources\admin\user\UserGetAllCollection;
use App\Http\Resources\admin\user\UserRecycleBinCollection;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
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
            $result = User::join('role', 'role.id', '=', 'user.role_id')
                ->whereNull('role.deleted_at')
                ->whereNull('user.deleted_at')
                ->orderby('role.disabled', 'asc')
                ->orderby('user.role_id', 'asc')
                ->orderby('user.disabled', 'asc')
                ->orderby('user.created_at', 'asc')
                ->select('user.*', 'role.role_name', 'role.disabled as role_disable')
                ->get();

            return $this->responseData($this->formatJson(UserGetAllCollection::class, $result));
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * List user in recycle bin
     *
     * @return JsonResponse
     */
    public function recycleBin(): JsonResponse
    {
        try {
            $result = User::join('role', 'user.role_id', '=', 'role.id')
                ->whereNotNull('user.deleted_at')
                ->whereNull('role.deleted_at')
                ->orderby('user.deleted_at', 'desc')
                ->select('user.*', 'role.role_name', 'role.disabled as role_disable')
                ->get();

            return $this->responseData($this->formatJson(UserRecycleBinCollection::class, $result));
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
            $result = User::join('role', 'role.id', '=', 'user.role_id')
                ->where('user.id', $user)
                ->whereNull('role.deleted_at')
                ->whereNull('user.deleted_at')
                ->select('user.*', 'role.role_name', 'role.disabled as role_disable')
                ->get();

            return $this->responseData($this->formatJson(UserGetAllCollection::class, $result));
        } catch (Exception $exception){
            return $this->sendError500();
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
            $roleId = null;
            $fields = $request->all();

            $resultRole = Role::whereNull('deleted_at')
                ->where('disabled', false)
                ->where('id', $fields['role_id'])
                ->get();

            foreach ($resultRole as $v){
                $roleId = $v['id'];
            }

            if (!$roleId){
                return $this->sendMessage('Không tìm thấy vai trò', 404);
            }

            User::create([
                'login_id' => $fields['login_id'],
                'password' => Hash::make($fields['password']),
                'role_id' => $roleId,
                'email' => $fields['email'],
                'full_name' => $fields['full_name'],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'created_by' => auth()->user()->login_id
            ]);

            return $this->sendMessage('Tạo tài khoản thành công', 201);
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
            $fields = $request->all();

            $result = User::join('role', 'role.id', '=', 'user.role_id')
                ->whereNull('role.deleted_at')
                ->where('role.disabled', false)
                ->whereNull('user.deleted_at')
                ->where('user.disabled', false)
                ->where('user.id', $user)
                ->update([
                    'user.login_id' => $fields['login_id'],
                    'user.password' => Hash::make($fields['password']),
                    'user.role_id' => $fields['role_id'],
                    'user.email' => $fields['email'],
                    'user.full_name' => $fields['full_name'],
                    'user.updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'user.updated_by' => auth()->user()->login_id
                ]);

            if (!$result){
                return $this->sendMessage('Không tìm thấy! Tài khoản hoặc vai trò có thể đã bị vô hiệu hoá hoặc bị xoá', 404);
            }

            return $this->sendMessage('Cập nhật thành công');
        } catch (Exception $exception){
            return $this->sendError500();
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
                $userInf = User::findOrFail($user);
            } catch (ModelNotFoundException $exception){
                return $this->sendMessage('Tài khoản không tồn tại', 404);
            }

            if ($userInf->disabled == 0) {
                $status = 1;
                $message = 'Khoá thành công';
            } else {
                $status = 0;
                $message = 'Mở khoá thành công';
            }

            $roleInf = User::join('role', 'role.id', '=', 'user.role_id')
                ->where('user.id', $user)
                ->whereNull('role.deleted_at')
                ->where('role.disabled', false)
                ->select('role.disabled as role_disable', 'role.deleted_at as role_deleted_at')
                ->get();

            if (isset($roleInf[0]['role_disable']) && $roleInf[0]['role_disable'] == 1
                || isset($roleInf[0]['role_deleted_at']) && $roleInf[0]['role_deleted_at'] == null){
                    return $this->sendMessage('Không tìm thấy! Vai trò đã bị xoá hoặc vô hiệu hoá');
            }

            User::join('role', 'role.id', '=', 'user.role_id')
                ->where('user.id', $user)
                ->whereNull('user.deleted_at')
                ->update(['user.disabled' => $status]);

            return $this->sendMessage($message);
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Delete user by id
     *
     * @param $user
     * @return JsonResponse
     */
    public function destroy($user): JsonResponse
    {
        try {
            $result = User::join('role', 'role.id', '=', 'user.role_id')
                ->whereNull('role.deleted_at')
                ->where('role.disabled', false)
                ->whereNull('user.deleted_at')
                ->where('user.id', $user)
                ->update(['user.deleted_at' => Carbon::now('Asia/Ho_Chi_Minh'), 'user.disabled' => 1]);

            if (!$result){
                return $this->sendMessage('Không tìm thấy! Tài khoản có thể đã bị xoá hoặc vai trò không tồn tại', 404);
            }

            return $this->sendMessage('Xoá thành công');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Restore user in recycle bin
     *
     * @param $user
     * @return JsonResponse
     */
    public function restore($user): JsonResponse
    {
        try {
            $result = User::whereNotNull('deleted_at')
                ->where('id', $user)
                ->update(['deleted_at' => null]);

            if (!$result){
                return $this->sendMessage('Không tìm thấy! Tài khoản có thể đã được khôi phục', 404);
            }

            return $this->sendMessage('Đã khôi phục tài khoản');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }
}
