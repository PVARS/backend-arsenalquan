<?php


namespace App\Http\Controllers\api\admin;


use App\Http\Controllers\Controller;
use App\Http\Request\Role\RoleRequest;
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
                ->whereNull('deleted_at');

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
     * @param RoleRequest $request
     * @param $role
     * @return JsonResponse
     */
    public function update(RoleRequest $request, $role): JsonResponse
    {
        try {
            $fields = $request->all();

            $isUpdate = Role::where('id', $role)->update([
                'role_name' => $fields['role_name'],
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_by' => Auth::id()
            ]);
            if (!$isUpdate){
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
            try {
                $result = Role::findOrFail($role);
            } catch (ModelNotFoundException $exception){
                return $this->sendMessage('Không tìm thấy', 404);
            }

            if ($result->deleted_at){
                return $this->sendMessage('Không tìm thấy', 404);
            }

            if ($result->update(['deleted_at' => Carbon::now('Asia/Ho_Chi_Minh')]))
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
                $exception = 'Không tìm thấy';
                return $this->sendError500($exception);
            }

            if ($result->disabled == 0) {
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
