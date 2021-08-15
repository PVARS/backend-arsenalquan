<?php

namespace App\Http\Resources\admin\category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryGetAllResource extends JsonResource
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
            'category' => $this->category_name,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'status' => $disable,
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'created_by' => $this->login_id
        ];
    }
}
