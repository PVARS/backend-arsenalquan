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
    public function unauthorized($msg = 'Tên đăng nhập hoặc mật khẩu không chính xác!'): JsonResponse
    {
        return response()->json(['message'=>$msg], 401);
    }

    /**
     * Send error 500
     *
     * @param $msg
     * @return JsonResponse
     */
    public function sendError500($msg): JsonResponse
    {
        return response()->json(['message'=>$msg], 500);
    }
}
