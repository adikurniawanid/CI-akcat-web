<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Kategori;
use CodeIgniter\Validation\Rules;

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
            'kategori' => $this->model->get_kategori_list()
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('admin/v_kategori');
        echo view('templates/v_footer');
    }

    public function addKategori()
    {
        if (isset($_POST['buttonAddKategori'])) {
            $val = $this->validate([
                'nama_param' => [
                    'label' => 'Nama Kategori',
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_legth' => '{field} tidak boleh lebih dari 100 huruf.'
                    ]

                ],
                'nilai_param' => [
                    'label' => 'Nilai Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_legth' => '{field} tidak boleh lebih dari 100 huruf.'
                    ]
                ]
            ]);

            if (!$val) {
                session()->setFlashData('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('kategori'));
            } else {
                $id_param = uniqid();
                $kode_param = substr(md5(microtime()), rand(0, 26), 5);

                $data = [
                    'nama_param' => $this->request->getPost('nama_param'),
                    'nilai_param' => $this->request->getPost('nilai_param')
                ];

                $success = $this->model->add_kategori($id_param, $kode_param, $data['nama_param'], $data['nilai_param']);

                if ($success) {
                    $message = 'Kategori <b>' . $data['nama_param'] . '</b> berhasil ditambahkan';
                    session()->setFlashData('message', $message);
                    return redirect()->to(base_url('kategori'));
                }
            }
        } else {
            return redirect()->to(base_url('kategori'));
        }
    }

    public function arsipKategori($id_param)
    {
        $temp = $this->model->get_kategori_name($id_param);
        $nameTemp = $temp[0]['nama'];
        $success = $this->model->arsip_kategori($id_param);

        if ($success) {
            $message = 'Kategori <b>' . $nameTemp . '</b> berhasil diarsipkan';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('kategori'));
        }
    }

    public function deleteKategori($id_param)
    {
        $temp = $this->model->get_kategori_name($id_param);
        $nameTemp = $temp[0]['nama'];
        $success = $this->model->delete_kategori($id_param);

        if ($success) {
            $message = 'Kategori <b>' . $nameTemp . '</b> berhasil dihapus';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('kategori'));
        }
    }

    public function editKategori()
    {
        if (isset($_POST['buttonEditKategori'])) {
            $val = $this->validate([
                'nama_param' => [
                    'label' => 'Nama Kategori',
                    'rules' => 'required|max_length[100]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_legth' => '{field} tidak boleh lebih dari 100 huruf.'
                    ]

                ],
                'nilai_param' => [
                    'label' => 'Nilai Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_legth' => '{field} tidak boleh lebih dari 100 huruf.'
                    ]
                ]
            ]);

            if (!$val) {
                session()->setFlashData('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('kategori'));
            } else {

                $data = [
                    'id_param' => $this->request->getPost('id_param'),
                    'nama_param' => $this->request->getPost('nama_param'),
                    'nilai_param' => $this->request->getPost('nilai_param')
                ];

                $success = $this->model->edit_kategori($data['id_param'], $data['nama_param'], $data['nilai_param']);

                if ($success) {
                    $message = 'Kategori <b>' . $data['nama_param'] . '</b> berhasil diedit';
                    session()->setFlashData('message', $message);
                    return redirect()->to(base_url('kategori'));
                } else {
                    return redirect()->to(base_url('kategori'));
                }
            }
        }
    }
}
