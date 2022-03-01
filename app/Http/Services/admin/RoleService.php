<?php


namespace App\Http\Services\admin;


use App\Exceptions\ApiException;
use App\Http\Repositories\admin\RoleRepository;
use App\Http\Repositories\admin\UserRepository;
use App\Http\Services\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class RoleService extends Service
{
    /**
     * @var RoleRepository
     */
    protected $repository;

    /**
     * RoleService constructor.
     */
    public function __construct()
    {
        $this->repository = new RoleRepository();
    }

    /**
     * Get all role
     *
     * @param $request
     * @return mixed
     * @throws ApiException
     */
    public function list($request)
    {
        $input = ['role_name' => isset($request['role_name']) ? $request['role_name'] : ''];

        try {
            $result = $this->repository->list($input);
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * Get role by id
     *
     * @param $role
     * @return mixed
     * @throws ApiException
     */
    public function getById($role)
    {
        try {
            $result = $this->repository->getById($role);
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * Role find or fail exception
     *
     * @param $id
     * @return mixed
     * @throws ApiException
     */
    public function roleFindOrFail($id)
    {
        try {
            $result = $this->repository->roleFindOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ApiException('AQ-0011', 404);
        }

        return $result;
    }

    /**
     * List role in recycle bin
     *
     * @return mixed
     * @throws ApiException
     */
    public function recycleBin()
    {
        if (!Gate::allows(self::ACCESS_ADMIN)) throw new ApiException('AQ-0002', 403);

        try {
            $result = $this->repository->recycleBin();
        } catch (\Exception $e) {
            throw new ApiException('AQ-0000');
        }

        return $result;
    }

    /**
     * Create new role
     *
     * @param $request
     * @return mixed
     * @throws ApiException
     */
    public function createRole($request)
    {
        if (!Gate::allows(self::ACCESS_ADMIN_SYS)) throw new ApiException('AQ-0002', 403);

        $idMax = $this->getIdMax('role');

        $input = [
            'id' => $idMax,
            'role_name' => $request['role_name'],
            'created_at' => Carbon::now(),
            'created_by' => Auth::id()
        ];

        try {
            DB::beginTransaction();
            $this->repository->create($input);
            DB::commit();

            return $this->getById($idMax);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Update role by id
     *
     * @param $request
     * @param $role
     * @return mixed
     * @throws ApiException
     */
    public function updateRole($request, $role)
    {
        if (!Gate::allows(self::ACCESS_ADMIN_SYS)) throw new ApiException('AQ-0002', 403);

        $this->roleFindOrFail($role);

        $input = [
            'role_name' => $request['role_name'],
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::id()
        ];

        try {
            DB::beginTransaction();
            $this->repository->update($input, $role);
            DB::commit();

            return $this->getById($role);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Delete role by id
     *
     * @param $role
     * @return mixed
     * @throws ApiException
     */
    public function delete($role)
    {
        if (!Gate::allows(self::ACCESS_ADMIN_SYS)) throw new ApiException('AQ-0002', 403);

        $roleResult = $this->roleFindOrFail($role);

        $userRepo = new UserRepository();
        $userResult = $userRepo->findFullUserByRole($role);

        if (!$userResult->isEmpty()) {
            throw new ApiException('AQ-0012', 200);
        }

        if ($roleResult->deleted_at) {
            throw new ApiException('AQ-0013', 200);
        }

        $input = ['deleted_at' => Carbon::now()];

        try {
            DB::beginTransaction();
            $this->repository->delete($input, $role);
            DB::commit();

            return $this->getById($role);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Disable role
     *
     * @param $role
     * @return string
     * @throws ApiException
     */
    public function disable($role)
    {
        if (!Gate::allows(self::ACCESS_ADMIN_SYS)) throw new ApiException('AQ-0002', 403);

        $roleResult = $this->roleFindOrFail($role);

        if ($roleResult->disabled == 0) {
            $status = true;
            $message = 'Đã khoá.';
        } else {
            $status = false;
            $message = 'Mở khoá thành công.';
        }

        $input = ['disabled' => $status];

        try {
            DB::beginTransaction();
            $this->repository->delete($input, $role);
            DB::commit();

            return $message;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }

    /**
     * Restore role
     *
     * @param $role
     * @throws ApiException
     */
    public function restore($role)
    {
        if (!Gate::allows(self::ACCESS_ADMIN_SYS)) throw new ApiException('AQ-0002', 403);

        $this->roleFindOrFail($role);

        $input = ['deleted_at' => null];

        try {
            DB::beginTransaction();
            $this->repository->restore($input, $role);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ApiException('AQ-0000');
        }
    }
}
