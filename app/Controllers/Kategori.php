<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Kategori;

class Kategori extends BaseController
{
    public function __construct()
    {
        $this->model = new M_Kategori();
    }

    public function index()
    {
        $data = [
            'judul' => 'Kategori Soal',
            'siswa' => $this->model->get_kategori_list()
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/kategori');
        echo view('templates/v_footer');
    }

    public function addKategori()
    {
        $data = [
            'nama_param' => $this->request->getPost('nama_param'),
            'nilai_param' => $this->request->getPost('nilai_param')
        ];

        $success = $this->model->addKategori($data);

        if ($success) {
            return redirect()->to(base_url('admin/kategori'));
        }
    }
}
