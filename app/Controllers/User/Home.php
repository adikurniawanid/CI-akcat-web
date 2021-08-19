<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Dashboard'
        ];

        return view('user/index', $data);
    }
}
