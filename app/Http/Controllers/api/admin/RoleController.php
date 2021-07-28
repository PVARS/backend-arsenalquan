<?php


namespace App\Http\Controllers\api\admin;


use App\Http\Controllers\Controller;
use App\Http\Request\Role\StoreRoleRequest;
use App\Http\Request\Role\UpdateRoleRequest;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
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
            $listRole = Role::all()
                ->whereNull('deleted_at')
                ->where('disabled', '=', 0);

            return $this->responseData($listRole);
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
            return $this->responseData(Role::findOrFail($role));
        } catch (ModelNotFoundException $exception){
            $exception = 'Không tìm thấy';
            return $this->sendError500($exception);
        }
    }

    /**
     * Create new role
     *
     * @param StoreRoleRequest $request
     * @return JsonResponse
     */
    public function store(StoreRoleRequest $request): JsonResponse
    {
        try {
            $fields = $request->all();

            Role::create([
                'role_name' => $fields['role_name'],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'created_by' => Auth::id()
            ]);

            return $this->sendMessage('Tạo thành công');
        } catch (QueryException $exception){
            return $this->sendError500();
        }
    }

    /**
     * Update role by id
     *
     * @param UpdateRoleRequest $request
     * @param $role
     * @return JsonResponse
     */
    public function update(UpdateRoleRequest $request, $role): JsonResponse
    {
        try {
            $fields = $request->all();

            $isUpdate = Role::where('id', $role)->update([
                'role_name' => $fields['role_name'],
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_by' => Auth::id()
            ]);
            if (!$isUpdate){
                return $this->sendMessage('Không tìm thấy');
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
            $isDelete = Role::where('id', $role)->update([
                'deleted_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            if (!$isDelete){
                return $this->sendMessage('Không tìm thấy');
            }
            return $this->sendMessage('Xoá thành công');
        } catch (QueryException $exception){
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
                $exception = 'Không tìm thấy';
                return $this->sendError500($exception);
            }
            $status = $result->disabled;
            if ($status == 0) {
                $status = 1;
                $message = 'Khoá thành công';
            } else {
                $status = 0;
                $message = 'Mở khoá thành công';
            }

            Role::where('id', $role)->update([
                'disabled' => $status
            ]);

            return $this->sendMessage($message);
        } catch (Exception $exception){
            return $this->sendError500();
        }
    }
}
