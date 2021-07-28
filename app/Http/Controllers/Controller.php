<?php

namespace App\Http\Controllers;

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
    public function forbidden(): JsonResponse
    {
        return response()->json(['message'=>'Forbidden'], 403);
    }

    /**
     * Unauthorized
     *
     * @return JsonResponse
     */
    public function unauthorized(): JsonResponse
    {
        return response()->json(['message'=>'Unauthorized'], 401);
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
}
