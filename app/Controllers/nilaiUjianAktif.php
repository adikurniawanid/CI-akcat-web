<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class NilaiUjianAktif extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Nilai Ujian',
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/v_nilaiUjianAktif');
        echo view('templates/v_footer');
    }
}
