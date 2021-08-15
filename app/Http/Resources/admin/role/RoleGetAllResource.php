<?php

namespace App\Http\Resources\admin\role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleGetAllResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $disable = 'Vô hiệu hoá';
        if ($this->disabled === 0){
            $disable = 'Đang hoạt động';
        }

        return [
            'id' => $this->id,
            'role_name' => $this->role_name,
            'status' => $disable,
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'created_by' => $this->created_by
        ];
    }
}
