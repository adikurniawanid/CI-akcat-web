<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Peserta;

class Peserta extends BaseController
{
    public function __construct()
    {
        $this->model = new M_Peserta();
    }

    public function index()
    {
        $data = [
            'judul' => 'Peserta',
            'peserta' => $this->model->get_peserta_list(),
            'jenisKelamin' => $this->model->get_jenis_kelamin_list()
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/v_peserta');
        echo view('templates/v_footer');
    }

    public function arsip()
    {
        $data = [
            'judul' => 'Arsip Peserta',
            'peserta' => $this->model->get_peserta_arsip_list()
        ];
        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/v_pesertaArsip');
        echo view('templates/v_footer');
    }

    public function deletePesertaArsip($id_param)
    {
        $temp = $this->model->get_peserta_name($id_param);
        $namaTemp = $temp[0]['nama'];
        $success = $this->model->delete_peserta($id_param);

        if ($success) {
            $message = 'Arsip peserta : <b>' . $namaTemp . '</b> berhasil dihapus';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/Peserta/Arsip'));
        }
    }

    public function recoveryPeserta($id_param)
    {
        $temp = $this->model->get_peserta_name($id_param);
        $namaTemp = $temp[0]['nama'];
        $success = $this->model->recovery_peserta($id_param);

        if ($success) {
            $message = 'Peserta <b>' . $namaTemp . '</b> berhasil dipulihkan';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/Peserta/Arsip'));
        }
    }

    public function arsipPeserta($id_param)
    {
        $temp = $this->model->get_peserta_name($id_param);
        $namaTemp = $temp[0]['nama'];
        $success = $this->model->arsip_peserta($id_param);

        if ($success) {
            $message = 'Peserta : <b>' . $namaTemp . '</b> berhasil diarsipkan';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/Peserta'));
        }
    }

    public function deletePeserta($id_param)
    {
        $temp = $this->model->get_peserta_name($id_param);
        $namaTemp = $temp[0]['nama'];
        $success = $this->model->delete_peserta($id_param);

        if ($success) {
            $message = 'Peserta : <b>' . $namaTemp . '</b> berhasil dihapus';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/Peserta'));
        }
    }

    public function addPeserta()
    {
        if (isset($_POST['buttonAddPeserta'])) {
            $val = $this->validate([
                'nama_param' => [
                    'label' => 'Nama Peserta',
                    'rules' => 'required|max_length[50]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_length' => '{field} tidak boleh lebih dari 50 karakter.'
                    ]

                ],
                'no_hp_param' => [
                    'label' => 'No Handphone',
                    'rules' => 'required',
                    'rules' => 'required|max_length[18]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_length' => '{field} tidak boleh lebih dari 18 angka.'
                    ]
                ],
                'instansi_param' => [
                    'label' => 'Instansi',
                    'rules' => 'required|max_length[50]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_length' => '{field} tidak boleh lebih dari 50 karakter.'
                    ]
                ],
                'username_param' => [
                    'label' => 'Username',
                    'rules' => 'required|max_length[50]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_length' => '{field} tidak boleh lebih dari 20 karakter.'
                    ]
                ],
                'email_param' => [
                    'label' => 'Email',
                    'rules' => 'required|max_length[50]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_length' => '{field} tidak boleh lebih dari 50 karakter.'
                    ]
                ],
                'password_param' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'jenis_kelamin_id_param' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
            ]);

            if (!$val) {
                session()->setFlashData('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('Admin/Peserta'));
            } else {
                $data = [
                    'id_param' => uniqid(),
                    'nama_param' => $this->request->getPost('nama_param'),
                    'username_param' => $this->request->getPost('username_param'),
                    'email_param' => $this->request->getPost('email_param'),
                    'password_param' => $this->request->getPost('password_param'),
                    'jenis_kelamin_id_param' => $this->request->getPost('jenis_kelamin_id_param'),
                    'no_hp_param' => $this->request->getPost('no_hp_param'),
                    'instansi_param' => $this->request->getPost('instansi_param'),
                ];

                $success = $this->model->add_peserta(
                    $data['id_param'],
                    $data['username_param'],
                    $data['email_param'],
                    $data['password_param'],
                    $data['nama_param'],
                    $data['jenis_kelamin_id_param'],
                    $data['no_hp_param'],
                    $data['instansi_param']
                );

                if ($success) {
                    $message = 'Peserta <b>' . $data['nama_param'] . '</b> berhasil ditambahkan';
                    session()->setFlashData('message', $message);
                    return redirect()->to(base_url('Admin/Peserta'));
                }
            }
        } else {
            return redirect()->to(base_url('Admin/Peserta'));
        }
    }
}
