<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class NilaiUjianArsip extends BaseController
{
    public function index()
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
