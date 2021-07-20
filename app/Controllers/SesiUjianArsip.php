<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_SesiUjian;

class SesiUjianArsip extends BaseController
{
    public function index()
    {
        $model = new M_SesiUjian();

        $data = [
            'judul' => 'Arsip Sesi Ujian',
            'sesi' => $model->get_sesi_ujian_arsip_list()
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/v_sesiUjianArsip');
        echo view('templates/v_footer');
    }
}
