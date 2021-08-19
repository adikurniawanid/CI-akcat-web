<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Auth;

class Home extends BaseController
{
    public function __construct()
    {
        $this->model = new M_Auth;
    }

    public function index()
    {
        $data = [
            'judul' => 'Dashboard',
            'jumlahPeserta' => $this->model->get_jumlah_peserta(),
            'jumlahSesi' => $this->model->get_jumlah_sesi(),
            'jumlahPertanyaan' => $this->model->get_jumlah_pertanyaan(),
            'jumlahKategori' => $this->model->get_jumlah_kategori(),
        ];

        return view('admin/index', $data);
    }
}
