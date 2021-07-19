<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Halaman Admin'
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/index');
        echo view('templates/v_footer');
    }

    public function kategori()
    {
        $data = [
            'judul' => 'Kategori Soal'
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/kategori');
        echo view('templates/v_footer');
    }
}
