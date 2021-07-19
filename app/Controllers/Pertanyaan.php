<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Pertanyaan;

class Pertanyaan extends BaseController
{
    public function __construct()
    {
        $this->model = new M_Pertanyaan();
    }

    public function index()
    {
        $data = [
            'judul' => 'Pertanyaan',
            'siswa' => $this->model->get_pertanyaan_list()
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/pertanyaan');
        echo view('templates/v_footer');
    }
}
