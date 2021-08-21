<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class NilaiUjian extends BaseController
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            return redirect()->to(base_url('Auth/Login'));
        }

        $data = [
            'judul' => 'Nilai Ujian',
        ];

        return view('admin/v_nilaiUjian', $data);
    }

    public function nilaiUjianArsip()
    {
        $data = [
            'judul' => 'Arsip Nilai Ujian',
        ];

        return view('admin/v_nilaiUjianArsip', $data);
    }
}
