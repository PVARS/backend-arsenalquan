<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Homepage extends Component
{
    public function render()
    {
        return view('livewire.admin.homepage', ['title' => 'Bảng điều khiển']);
    }
}
