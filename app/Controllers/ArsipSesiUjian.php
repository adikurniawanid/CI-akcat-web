<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_SesiUjian;

class ArsipSesiUjian extends BaseController
{
    public function index()
    {
        $model = new M_SesiUjian();

        $data = [
            'judul' => 'Arsip Sesi Ujian',
            'siswa' => $model->get_sesi_ujian_arsip_list()
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/arsipSesiUjian');
        echo view('templates/v_footer');
    }
}
