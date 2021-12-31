<?php


namespace App\Http\Services\admin;


use App\Exceptions\ApiException;
use App\Http\Repositories\admin\UserRepository;
use App\Http\Services\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserService extends Service
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * UserService constructor.
     */
    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    /**
     * Get all user
     *
     * @return mixed
     * @throws ApiException
     */
    public function list()
    {
        try {
            $result = $this->repository->list();
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * Find or fail
     *
     * @param $user
     * @return
     * @throws ApiException
     */
    public function userFindOrFail($user)
    {
        try {
            $result = $this->repository->userFindOrFail($user);
        } catch (ModelNotFoundException $exception) {
            throw new ApiException('AQ-0015', 404);
        }

        return $result;
    }

    /**
     * Get user by id
     *
     * @param $user
     * @return mixed
     * @throws ApiException
     */
    public function getById($user)
    {
        try {
            $result = $this->repository->getById($user);
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * List user in recycle bin
     *
     * @return mixed
     * @throws ApiException
     */
    public function recycleBin()
    {
        if (!Gate::allows(self::ACCESS_ADMIN)) throw new ApiException('AQ-0002', 401);

        try {
            $result = $this->repository->recycleBin();
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * Register user
     *
     * @param $request
     * @return mixed
     * @throws ApiException
     */
    public function register($request)
    {
        if (!Gate::allows(self::ACCESS_ADMIN_SYS)) throw new ApiException('AQ-0002', 401);

        $roleId = $request['role_id'];

        $roleService = new RoleService();

        //Check exist role
        $roleResult = $roleService->roleFindOrFail($roleId);

        //Check status role
        if ($roleResult->disabled == true || $roleResult->deleted_at) {
            throw new ApiException('AQ-0013', 200);
        }

        $idMax = $this->getIdMax('user');

        $input = [
            'id' => $idMax,
            'login_id' => $request['login_id'],
            'password' => Hash::make($request['password']),
            'role_id' => $roleId,
            'email' => $request['email'],
            'full_name' => $request['full_name'],
            'created_at' => Carbon::now(),
            'created_by' => Auth::id()
        ];

        try {
            DB::beginTransaction();
            $this->repository->register($input);
            DB::commit();

            return $this->getById($idMax);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Update user by id
     *
     * @param $request
     * @param $user
     * @return mixed
     * @throws ApiException
     */
    public function update($request, $user)
    {
        if (!Gate::allows(self::ACCESS_ADMIN_SYS)) throw new ApiException('AQ-0002', 401);

        $roleId = $request['role_id'];

        $roleService = new RoleService();

        //Check exist role
        $roleResult = $roleService->roleFindOrFail($roleId);
        //Check exist user
        $userResult = $this->userFindOrFail($user);

        //Check status role
        if ($roleResult->disabled == true || $roleResult->deleted_at) {
            throw new ApiException('AQ-0013', 200);
        }

        //Check status user
        if ($userResult->deleted_at) {
            throw new ApiException('AQ-0014', 200);
        }

        $input = [
            'user.login_id' => $request['login_id'],
            'user.password' => Hash::make($request['password']),
            'user.role_id' => $request['role_id'],
            'user.email' => $request['email'],
            'user.full_name' => $request['full_name'],
            'user.updated_at' => Carbon::now(),
            'user.updated_by' => Auth::id()
        ];

        try {
            DB::beginTransaction();
            $this->repository->update($input, $user);
            DB::commit();

            return $this->getById($user);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Update profile
     *
     * @param $request
     * @param $user
     * @return mixed
     * @throws ApiException
     */
    public function updateProfile($request, $user)
    {
        $roleId = $request['role_id'];

        $roleService = new RoleService();

        //Check exist role
        $roleResult = $roleService->roleFindOrFail($roleId);
        //Check exist user
        $userResult = $this->userFindOrFail($user);

        //Check status role
        if ($roleResult->disabled == true || $roleResult->deleted_at) {
            throw new ApiException('AQ-0013', 200);
        }

        //Check status role
        if ($userResult->deleted_at || $user != Auth::id()) {
            throw new ApiException('AQ-0014', 200);
        }

        $input = [
            'user.login_id' => $request['login_id'],
            'user.password' => Hash::make($request['password']),
            'user.email' => $request['email'],
            'user.full_name' => $request['full_name'],
            'user.updated_at' => Carbon::now(),
            'user.updated_by' => Auth::id()
        ];

        try {
            DB::beginTransaction();
            $this->repository->update($input, $user);
            DB::commit();

            auth()->user()->tokens()->delete();

            return $this->getById($user);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Disable by id
     *
     * @param $user
     * @return string
     * @throws ApiException
     */
    public function disable($user)
    {
        if (!Gate::allows(self::ACCESS_ADMIN_SYS)) throw new ApiException('AQ-0002', 401);

        $roleService = new RoleService();

        //Check exist user
        $userResult = $this->userFindOrFail($user);

        //Check exist role
        $roleResult = $roleService->roleFindOrFail($userResult->role_id);

        if ($user == Auth::id()) {
            throw new ApiException('AQ-0016', 200);
        }

        //Check status role
        if ($roleResult->disabled == true || $roleResult->deleted_at) {
            throw new ApiException('AQ-0013', 200);
        }

        //Check status role
        if ($userResult->deleted_at) {
            throw new ApiException('AQ-0014', 200);
        }

        if ($userResult->disabled == false) {
            $status = 1;
            $message = 'Khoá thành công.';
        } else {
            $status = 0;
            $message = 'Mở khoá thành công.';
        }

        $input = ['user.disabled' => $status];

        try {
            DB::beginTransaction();
            $this->repository->disable($input, $user);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }

        return $message;
    }

    /**
     * Delete user by id
     *
     * @param $user
     * @throws ApiException
     */
    public function delete($user)
    {
        if (!Gate::allows(self::ACCESS_ADMIN_SYS)) throw new ApiException('AQ-0002', 401);

        $this->userFindOrFail($user);

        if ($user == Auth::id()) {
            throw new ApiException('AQ-0017', 200);
        }

        $input = [
            'user.deleted_at' => Carbon::now(),
            'user.disabled' => 1
        ];

        try {
            DB::beginTransaction();
            $this->repository->delete($input, $user);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Restore user in recycle bin
     *
     * @param $user
     * @throws ApiException
     */
    public function restore($user)
    {
        if (!Gate::allows(self::ACCESS_ADMIN_SYS)) throw new ApiException('AQ-0002', 401);

        $this->userFindOrFail($user);

        $input = ['deleted_at' => null];

        try {
            DB::beginTransaction();
            $this->repository->restore($input, $user);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }
}
