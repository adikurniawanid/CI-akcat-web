<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class NilaiUjian extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Nilai Ujian',
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/v_nilaiUjian');
        echo view('templates/v_footer');
    }

    public function nilaiUjianArsip()
    {
        $data = [
            'judul' => 'Arsip Nilai Ujian',
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/v_nilaiUjianArsip');
        echo view('templates/v_footer');
    }
}
