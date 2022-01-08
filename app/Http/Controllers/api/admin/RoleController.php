<?php


namespace App\Http\Controllers\api\admin;


use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use App\Http\Request\Role\RoleRequest;
use App\Http\Resources\admin\role\RoleGetAllCollection;
use App\Http\Resources\admin\role\RoleGetAllResource;
use App\Http\Resources\admin\role\RoleRecycleBinCollection;
use App\Http\Services\admin\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    protected $service;

    /**
     * RoleController constructor.
     */
    public function __construct()
    {
        $this->service = new RoleService();
    }

    /**
     * Get all role
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function findAll(Request $request): JsonResponse
    {
        $fields = $request->all();

        $result = $this->service->list($fields);

        return $this->success($this->formatJson(RoleGetAllCollection::class, $result));
    }

    /**
     * List role in recycle bin
     *
     * @return JsonResponse
     * @throws ApiException
     */
    public function recycleBin(): JsonResponse
    {
        $result = $this->service->recycleBin();

        return $this->success($this->formatJson(RoleRecycleBinCollection::class, $result));
    }

    /**
     * Get role by id
     *
     * @param $role
     * @return JsonResponse
     * @throws ApiException
     */
    public function getById($role): JsonResponse
    {
        $result = $this->service->getById($role);

        return $this->success($this->formatJson(RoleGetAllResource::class, $result));
    }

    /**
     * Create new role
     *
     * @param RoleRequest $request
     * @return JsonResponse
     * @throws ApiException
     */
    public function store(RoleRequest $request): JsonResponse
    {
        $fields = $request->all();

        $result = $this->service->createRole($fields);
        $this->message = 'Tạo thành công.';

        return $this->success($this->formatJson(RoleGetAllResource::class, $result));
    }

    /**
     * Update role by id
     *
     * @param RoleRequest $request
     * @param $role
     * @return JsonResponse
     * @throws ApiException
     */
    public function update(RoleRequest $request, $role): JsonResponse
    {
        $fields = $request->all();

        $result = $this->service->updateRole($fields, $role);
        $this->message = 'Cập nhật thành công.';

        return $this->success($this->formatJson(RoleGetAllResource::class, $result));
    }

    /**
     * Delete role by id
     *
     * @param $role
     * @return JsonResponse
     * @throws ApiException
     */
    public function destroy($role): JsonResponse
    {
        $this->service->delete($role);
        $this->message = 'Xoá thành công.';

        return $this->success();
    }

    /**
     * Disable role
     *
     * @param $role
     * @return JsonResponse
     * @throws ApiException
     */
    public function disable($role): JsonResponse
    {
        $result = $this->service->disable($role);
        $this->message = $result;

        return $this->success();
    }

    /**
     * Restore role in recycle bin
     *
     * @param $role
     * @return JsonResponse
     * @throws ApiException
     */
    public function restore($role): JsonResponse
    {
        $this->service->restore($role);
        $this->message = 'Đã khôi phục.';

        return $this->success();
    }
}
