<?php

namespace App\Http\Resources\admin\user;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserGetAllResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $status = 'Đang hoạt động';
        $statusCode = 0;
        if ($this->disabled === 1 || $this->role_disable === 1){
            $status = 'Vô hiệu hoá';
            $statusCode = 1;
        }

        $createAt = $this->created_at;
        if (!$createAt){
            $createAt = Carbon::now();
        }

        return [
            'id' => $this->id,
            'login_id' => $this->login_id,
            'role' => $this->role_name,
            'email' => $this->email,
            'full_name' => $this->full_name,
            'status' => $status,
            'statusCode' => $statusCode,
            'created_at' => $createAt->format('d-m-Y H:i:s')
        ];
    }
}
