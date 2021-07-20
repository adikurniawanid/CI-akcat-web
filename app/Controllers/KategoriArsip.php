<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Kategori;
use CodeIgniter\Validation\Rules;

class KategoriArsip extends BaseController
{
    public function __construct()
    {
        $this->model = new M_Kategori();
    }
    public function index()
    {
        $data = [
            'judul' => 'Arsip Kategori Soal',
            'kategori' => $this->model->get_kategori_arsip_list()
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/v_kategoriArsip');
        echo view('templates/v_footer');
    }

    public function deleteKategori($id_param)
    {
        $temp = $this->model->get_kategori_name($id_param);
        $nameTemp = $temp[0]['nama'];
        $success = $this->model->delete_kategori($id_param);

        if ($success) {
            $message = 'Kategori <b>' . $nameTemp . '</b> berhasil dihapus';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('kategoriArsip'));
        }
    }

    public function recoveryKategori($id_param)
    {
        $temp = $this->model->get_kategori_name($id_param);
        $nameTemp = $temp[0]['nama'];
        $success = $this->model->recovery_kategori($id_param);

        if ($success) {
            $message = 'Kategori <b>' . $nameTemp . '</b> berhasil dipulihkan';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('kategoriArsip'));
        }
    }
}
