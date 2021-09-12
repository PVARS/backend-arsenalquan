<?php

namespace App\Http\Controllers;

class LoginController
{
    public function login()
    {
        return view('livewire.admin.login');
    }
}