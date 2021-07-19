<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_SesiUjian;

class SesiUjianAktif extends BaseController
{
    public function index()
    {
        $model = new M_SesiUjian();

        $data = [
            'judul' => 'Sesi Ujian',
            'siswa' => $model->get_sesi_ujian_aktif_list()
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/sesiUjianAktif');
        echo view('templates/v_footer');
    }
}
