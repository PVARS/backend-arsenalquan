<?php

namespace App\Http\Controllers\api\admin;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Request\User\UserRequest;
use App\Http\Resources\admin\user\UserGetAllCollection;
use App\Http\Resources\admin\user\UserGetAllResource;
use App\Http\Resources\admin\user\UserRecycleBinCollection;
use App\Http\Services\admin\UserService;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $service;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->service = new UserService();
    }

    /**
     * Get all user
     *
     * @return JsonResponse
     * @throws ApiException
     */
    public function findAll(): JsonResponse
    {
        $result = $this->service->list();

        return $this->success($this->formatJson(UserGetAllCollection::class, $result));
    }

    /**
     * List user in recycle bin
     *
     * @return JsonResponse
     * @throws ApiException
     */
    public function recycleBin(): JsonResponse
    {
        $result = $this->service->recycleBin();

        return $this->success($this->formatJson(UserRecycleBinCollection::class, $result));
    }

    /**
     * Get user by id
     *
     * @param $user
     * @return JsonResponse
     * @throws ApiException
     */
    public function getById($user): JsonResponse
    {
        $result = $this->service->getById($user);

        return $this->success($this->formatJson(UserGetAllResource::class, $result));
    }

    /**
     * Register new user
     *
     * @param UserRequest $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function register(UserRequest $request): JsonResponse
    {
        $fields = $request->all();
        $result = $this->service->register($fields);
        $this->message = 'Đăng ký tài khoản thành công.';

        return $this->success($this->formatJson(UserGetAllResource::class, $result), 201);
    }

    /**
     * Update user by id
     *
     * @param UserRequest $request
     * @param $user
     * @return JsonResponse
     * @throws ApiException
     */
    public function update(UserRequest $request, $user): JsonResponse
    {
        $fields = $request->all();
        $result = $this->service->update($fields, $user);
        $this->message = 'Cập nhật thành công.';

        return $this->success($this->formatJson(UserGetAllResource::class, $result), 200);
    }

    /**
     * Update profile user
     *
     * @param UserRequest $request
     * @param $user
     * @return JsonResponse
     * @throws ApiException
     */
    public function updateProfile(UserRequest $request, $user): JsonResponse
    {
        $fields = $request->all();
        $result = $this->service->updateProfile($fields, $user);
        $this->message = 'Cập nhật thành công.';

        return $this->success($this->formatJson(UserGetAllResource::class, $result), 200);
    }

    /**
     * Disable by id
     *
     * @param $user
     * @return JsonResponse
     * @throws ApiException
     */
    public function disable($user): JsonResponse
    {
        $result = $this->service->disable($user);
        $this->message = $result;

        return $this->success();
    }

    /**
     * Delete user by id
     *
     * @param $user
     * @return JsonResponse
     * @throws ApiException
     */
    public function destroy($user): JsonResponse
    {
        $this->service->delete($user);
        $this->message = 'Xoá thành công.';

        return $this->success();
    }

    /**
     * Restore user in recycle bin
     *
     * @param $user
     * @return JsonResponse
     * @throws ApiException
     */
    public function restore($user): JsonResponse
    {
        $this->service->restore($user);
        $this->message = 'Đã khôi phục tài khoản.';

        return $this->success();
    }
}
