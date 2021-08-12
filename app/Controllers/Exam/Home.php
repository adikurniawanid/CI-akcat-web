<?php

namespace App\Controllers\Exam;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Ujian'
        ];

        return view('exam/index', $data);
    }
}
