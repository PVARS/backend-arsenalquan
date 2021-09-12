<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Send any message
     *
     * @param $msg
     * @param int $code
     * @return JsonResponse
     */
    public function sendMessage($msg, int $code = 200): JsonResponse
    {
        return response()->json(['message' => $msg] , $code);
    }

    /**
     * Send array information
     *
     * @param array $info
     * @param int $code
     * @return JsonResponse
     */
    public function sendInformation(array $info = [], int $code = 200): JsonResponse
    {
        return response()->json($info, $code);
    }

    /**
     * Send not found
     *
     * @param $msg
     * @return JsonResponse
     */
    public function sendError400($msg): JsonResponse
    {
        return response()->json(['message'=>$msg], 404);
    }

    /**
     * Forbidden
     *
     * @return JsonResponse
     */
    public function forbidden($msg = 'Bạn không có quyền truy cập!'): JsonResponse
    {
        return response()->json(['message' => $msg], 403);
    }

    /**
     * Unauthorized
     *
     * @return JsonResponse
     */
    public function unauthorized($msg = 'Tên đăng nhập hoặc mật khẩu không chính xác !'): JsonResponse
    {
        return response()->json(['message'=>$msg], 401);
    }

    /**
     * Send error 500
     *
     * @param string $msg
     * @return JsonResponse
     */
    public function sendError500(string $msg = 'Lỗi hệ thống. Vui lòng quay lại sau'): JsonResponse
    {
        return response()->json(['message'=>$msg], 500);
    }

    /**
     * @param $arr
     * @return JsonResponse
     */
    public function responseData($arr): JsonResponse
    {
        return response()->json($arr);
    }

    /**
     * @param $className
     * @param $item
     * @param null $other
     * @return mixed
     */
    public function formatJson($className, $item, $other = NULL)
    {
        return new $className($item, $other);
    }

    /**
     * Find category
     *
     * @param $category
     * @return bool
     */
    public function findCategory($category): bool
    {
        $categoryId = null;

        $resultCategory = Category::whereNull('deleted_at')
            ->where('category.disabled', false)
            ->where('id', $category)
            ->get();

        foreach ($resultCategory as $v){
            $categoryId = $v['id'];
        }

        if (!$categoryId){
            return false;
        }
        return true;
    }
}
