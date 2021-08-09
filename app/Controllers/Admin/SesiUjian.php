<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_SesiUjian;

class SesiUjian extends BaseController
{
    public function __construct()
    {
        $this->model = new M_SesiUjian();
    }

    public function index()
    {
        $model = new M_SesiUjian();

        $data = [
            'judul' => 'Sesi Ujian',
            'sesi' => $model->get_sesi_ujian_list()
        ];

        return view('admin/v_sesiUjian', $data);
    }

    public function arsip()
    {
        $data = [
            'judul' => 'Arsip Sesi Ujian',
            'sesi' => $this->model->get_sesi_ujian_arsip_list()
        ];

        return view('admin/v_sesiUjianArsip', $data);
    }

    public function addSesiUjian()
    {
        if (isset($_POST['buttonAddSesiUjian'])) {
            $val = $this->validate([
                'nama_param' => [
                    'label' => 'Nama Sesi Ujian',
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_length' => '{field} tidak boleh lebih dari 100 huruf.'
                    ]
                ],
                'lokasi_param' => [
                    'label' => 'Lokasi Ujian',
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_length' => '{field} tidak boleh lebih dari 100 huruf.'
                    ]
                ],
                'tanggal_ujian_param' => [
                    'label' => 'Tanggal Ujian',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'jam_ujian_param' => [
                    'label' => 'Jam Ujian',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'durasi_param' => [
                    'label' => 'Durasi Ujian',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ]
            ]);

            if (!$val) {
                session()->setFlashData('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('Admin/SesiUjian'));
            } else {
                $data = [
                    'nama_param' => $this->request->getPost('nama_param'),
                    'lokasi_param' => $this->request->getPost('lokasi_param'),
                    'tanggal_ujian_param' => $this->request->getPost('tanggal_ujian_param'),
                    'jam_ujian_param' => $this->request->getPost('jam_ujian_param'),
                    'durasi_param' => $this->request->getPost('durasi_param')
                ];

                $id_param = uniqid();
                $kode_param = substr(md5(microtime()), rand(0, 26), 5);
                $waktu_mulai_param = $data['tanggal_ujian_param'] . ' ' . $data['jam_ujian_param'];

                $success = $this->model->add_sesi_ujian($id_param, $kode_param, $data['nama_param'], $data['lokasi_param'], $waktu_mulai_param, $data['durasi_param']);

                if ($success) {
                    $message = 'Sesi <b>' . $data['nama_param'] . '</b> berhasil ditambahkan';
                    session()->setFlashData('message', $message);
                    return redirect()->to(base_url('Admin/SesiUjian'));
                }
            }
        } else {
            return redirect()->to(base_url('Admin/SesiUjian'));
        }
    }

    public function editSesiUjian()
    {
        if (isset($_POST['buttonEditSesiUjian'])) {
            $val = $this->validate([
                'nama_param' => [
                    'label' => 'Nama Sesi Ujian',
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_length' => '{field} tidak boleh lebih dari 100 huruf.'
                    ]
                ],
                'lokasi_param' => [
                    'label' => 'Lokasi Ujian',
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_length' => '{field} tidak boleh lebih dari 100 huruf.'
                    ]
                ],
                'tanggal_ujian_param' => [
                    'label' => 'Tanggal Ujian',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'jam_ujian_param' => [
                    'label' => 'Jam Ujian',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'durasi_param' => [
                    'label' => 'Durasi Ujian',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ]
            ]);

            if (!$val) {
                session()->setFlashData('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('Admin/SesiUjian'));
            } else {
                $data = [
                    'id_param' => $this->request->getPost('id_param'),
                    'nama_param' => $this->request->getPost('nama_param'),
                    'lokasi_param' => $this->request->getPost('lokasi_param'),
                    'tanggal_ujian_param' => $this->request->getPost('tanggal_ujian_param'),
                    'jam_ujian_param' => $this->request->getPost('jam_ujian_param'),
                    'durasi_param' => $this->request->getPost('durasi_param')
                ];

                $waktu_mulai_param = $data['tanggal_ujian_param'] . ' ' . $data['jam_ujian_param'];

                $success = $this->model->edit_sesi_ujian($data['id_param'], $data['nama_param'], $data['lokasi_param'], $waktu_mulai_param, $data['durasi_param']);

                if ($success) {
                    $message = 'Sesi Ujian <b>' . $data['nama_param'] . '</b> berhasil diedit';
                    session()->setFlashData('message', $message);
                    return redirect()->to(base_url('Admin/SesiUjian'));
                } else {
                    return redirect()->to(base_url('Admin/SesiUjian'));
                }
            }
        }
    }

    public function arsipSesiUjian($id_param)
    {
        $temp = $this->model->get_sesi_ujian_name($id_param);
        $nameTemp = $temp[0]['nama'];
        $success = $this->model->arsip_sesi_ujian($id_param);

        if ($success) {
            $message = 'Sesi <b>' . $nameTemp . '</b> berhasil diarsipkan';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/SesiUjian'));
        }
    }

    public function deleteSesiUjian($id_param)
    {
        $temp = $this->model->get_sesi_ujian_name($id_param);
        $nameTemp = $temp[0]['nama'];
        $success = $this->model->delete_sesi_ujian($id_param);

        if ($success) {
            $message = 'Sesi <b>' . $nameTemp . '</b> berhasil dihapus';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/SesiUjian'));
        }
    }

    public function deleteSesiUjianArsip($id_param)
    {
        $temp = $this->model->get_sesi_ujian_name($id_param);
        $nameTemp = $temp[0]['nama'];
        $success = $this->model->delete_sesi_ujian($id_param);

        if ($success) {
            $message = 'Sesi <b>' . $nameTemp . '</b> berhasil dihapus';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/SesiUjian/Arsip'));
        }
    }

    public function recoverySesiUjian($id_param)
    {
        $temp = $this->model->get_sesi_ujian_name($id_param);
        $nameTemp = $temp[0]['nama'];
        $success = $this->model->recovery_sesi_ujian($id_param);

        if ($success) {
            $message = 'Sesi <b>' . $nameTemp . '</b> berhasil dipulihkan';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/SesiUjian/Arsip'));
        }
    }
}
