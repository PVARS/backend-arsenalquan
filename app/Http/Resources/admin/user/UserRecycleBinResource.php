<?php

namespace App\Http\Resources\admin\user;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRecycleBinResource extends JsonResource
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

        return [
            'id' => $this->id,
            'login_id' => $this->login_id,
            'role' => $this->role_name,
            'email' => $this->email,
            'full_name' => $this->full_name,
            'status' => $status,
            'statusCode' => $statusCode,
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'deleted_at' => $this->deleted_at
        ];
    }
}
