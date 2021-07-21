<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
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
            'pertanyaan' => $this->model->get_pertanyaan_list()
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/v_pertanyaan');
        echo view('templates/v_footer');
    }

    public function arsipPertanyaan($id_param)
    {
        $temp = $this->model->get_pertanyaan_kode($id_param);
        $kodeTemp = $temp[0]['kode'];
        $success = $this->model->arsip_pertanyaan($id_param);

        if ($success) {
            $message = 'Pertanyaan dengan kode : <b>' . $kodeTemp . '</b> berhasil diarsipkan';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/pertanyaan'));
        }
    }

    public function deletePertanyaan($id_param)
    {
        $temp = $this->model->get_pertanyaan_kode($id_param);
        $kodeTemp = $temp[0]['kode'];
        $success = $this->model->delete_pertanyaan($id_param);

        if ($success) {
            $message = 'Pertanyaan dengan kode : <b>' . $kodeTemp . '</b> berhasil dihapus';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/pertanyaan'));
        }
    }

    public function pertanyaanArsip()
    {
        $data = [
            'judul' => 'Arsip Pertanyaan',
            'pertanyaan' => $this->model->get_pertanyaan_arsip_list()
        ];
        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/v_pertanyaanArsip');
        echo view('templates/v_footer');
    }

    public function recoveryPertanyaan($id_param)
    {
        $temp = $this->model->get_pertanyaan_kode($id_param);
        $kodeTemp = $temp[0]['kode'];
        $success = $this->model->recovery_pertanyaan($id_param);

        if ($success) {
            $message = 'Pertanyaan dengan kode : <b>' . $kodeTemp . '</b> berhasil dipulihkan';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/Pertanyaan/pertanyaanArsip'));
        }
    }

    public function deletePertanyaanArsip($id_param)
    {
        $temp = $this->model->get_pertanyaan_kode($id_param);
        $kodeTemp = $temp[0]['kode'];
        $success = $this->model->delete_pertanyaan($id_param);

        if ($success) {
            $message = 'Pertanyaan dengan kode : <b>' . $kodeTemp . '</b> berhasil dihapus';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/Pertanyaan/pertanyaanArsip'));
        }
    }
}
