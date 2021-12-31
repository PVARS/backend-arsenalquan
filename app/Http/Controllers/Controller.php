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

    public string $message = '';

    /**
     * @param array $data
     * @param int $status
     * @return JsonResponse
     */
    public function success($data = [], $status = 200): JsonResponse
    {
        return response()->json(['STATUS' => 'OK', 'MESSAGE' => $this->message, 'DATA' => $data], $status);
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
}
