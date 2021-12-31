<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Config;

class ApiException extends \Exception
{

    /**
     * @var int
     */
    protected int $statusCode;

    /**
     * @var string
     */
    protected string $errData = 'Không xác định!';

    /**
     * @var array
     */
    protected array $append;

    /**
     * @param string $errCode
     * @param int $statusCode
     */
    public function __construct(string $errCode, int $statusCode = 500)
    {
        $this->statusCode = $statusCode;
        $this->setErrData($errCode);
        parent::__construct(json_encode($this->errData));
    }

    /**
     * @param string $errCode
     * @return void
     */
    public function setErrData(string $errCode)
    {
        $error = Config::get('const.MESSAGE.' . $errCode);
        if ($error == null) {
            $this->errData = 'Không xác định!';
        } else {
            $this->errData = $error;
        }
    }

    /**
     * @return string
     */
    public function getErrData()
    {
        return $this->errData;
    }

    public function render()
    {
        $res = ['STATUS' => 'NG', 'MESSAGE' => $this->getErrData()];
        return response()->json($res, $this->statusCode);
    }
}
