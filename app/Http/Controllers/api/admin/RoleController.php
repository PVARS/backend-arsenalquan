<?php


namespace App\Http\Controllers\api\admin;


use App\Http\Controllers\Controller;
use App\Http\Request\Role\RoleRequest;
use App\Http\Resources\admin\role\RoleGetAllCollection;
use App\Http\Resources\admin\role\RoleRecycleBinCollection;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Exception;

class RoleController extends Controller
{
    /**
     * Get all role
     *
     * @return JsonResponse
     */
    public function findAll(): JsonResponse
    {
        try {
            $result = Role::whereNull('deleted_at')
                ->orderby('id', 'asc')
                ->orderby('disabled', 'asc')
                ->get();

            return $this->responseData($this->formatJson(RoleGetAllCollection::class, $result));
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * List role in recycle bin
     *
     * @return JsonResponse
     */
    public function recycleBin(): JsonResponse
    {
        try {
            $result = Role::whereNotNull('deleted_at')
                ->orderby('deleted_at', 'desc')
                ->get();

            return $this->responseData($this->formatJson(RoleRecycleBinCollection::class, $result));
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Get role by id
     *
     * @param $role
     * @return JsonResponse
     */
    public function getById($role): JsonResponse
    {
        try {
            $result = Role::whereNull('deleted_at')
                ->where('id', $role)
                ->orderby('id', 'asc')
                ->orderby('disabled', 'asc')
                ->get();

            return $this->responseData($this->formatJson(RoleGetAllCollection::class, $result));
        } catch (ModelNotFoundException $exception){
            return $this->sendMessage('Không tìm thấy', 404);
        }
    }

    /**
     * Create new role
     *
     * @param RoleRequest $request
     * @return JsonResponse
     */
    public function store(RoleRequest $request): JsonResponse
    {
        try {
            $fields = $request->all();

            Role::create([
                'role_name' => $fields['role_name'],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'created_by' => auth()->user()->login_id
            ]);

            return $this->sendMessage('Tạo thành công', 201);
        } catch (QueryException $exception){
            return $this->sendError500();
        }
    }

    /**
     * Update role by id
     *
     * @param RoleRequest $request
     * @param $role
     * @return JsonResponse
     */
    public function update(RoleRequest $request, $role): JsonResponse
    {
        try {
            $fields = $request->all();

            $result = Role::where('id', $role)->update([
                'role_name' => $fields['role_name'],
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_by' => auth()->user()->login_id
            ]);

            if (!$result){
                return $this->sendMessage('Không tìm thấy', 404);
            }
            return $this->sendMessage('Cập nhật thành công');
        } catch (QueryException $exception){
            return $this->sendError500();
        }
    }

    /**
     * Delete role by id
     *
     * @param $role
     * @return JsonResponse
     */
    public function destroy($role): JsonResponse
    {
        try {
            $result = Role::whereNull('deleted_at')
                ->where('id', $role)
                ->update(['deleted_at' => Carbon::now('Asia/Ho_Chi_Minh')]);

            if (!$result){
                return $this->sendMessage('Không tìm thấy vai trò', 404);
            }

            return $this->sendMessage('Xoá thành công');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Disable role
     *
     * @param $role
     * @return JsonResponse
     */
    public function disable($role): JsonResponse
    {
        try {
            try {
                $result = Role::findOrFail($role);
            } catch (ModelNotFoundException $exception){
                return $this->sendMessage('Vai trò không tồn tại', 404);
            }

            if ($result->disabled == 0) {
                $status = true;
                $message = 'Đã khoá';
            } else {
                $status = false;
                $message = 'Mở khoá thành công';
            }

            Role::whereNull('deleted_at')
                ->where('id', $role)
                ->update(['disabled' => $status]);

            return $this->sendMessage($message);
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }

    /**
     * Restore role in recycle bin
     *
     * @param $category
     * @return JsonResponse
     */
    public function restore($role): JsonResponse
    {
        try {
            $result = Role::whereNotNull('deleted_at')
                ->where('id', $role)
                ->update(['deleted_at' => null]);

            if (!$result){
                return $this->sendMessage('Không tìm thấy! Vai trò có thể đã được khôi phục', 404);
            }

            return $this->sendMessage('Đã khôi phục vai trò');
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }
}
