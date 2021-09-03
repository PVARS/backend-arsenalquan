<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Categories extends Component
{   
    public function render()
    {
        return view('livewire.admin.category.categories', 
            [
                'title' => 'Danh sách danh mục', 
                'baseAPI' => env('API_URL')
            ]
        );
    }
}
