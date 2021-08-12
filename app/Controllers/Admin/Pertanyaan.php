<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_Kategori;
use App\Models\M_Pertanyaan;

class Pertanyaan extends BaseController
{
    public function __construct()
    {
        $this->model = new M_Pertanyaan();
        $this->modelKategori = new M_Kategori();
    }

    public function index()
    {
        $data = [
            'judul' => 'Pertanyaan',
            'pertanyaan' => $this->model->get_pertanyaan_list(),
            'kategori_list' => $this->modelKategori->get_kategori_list()
        ];

        return view('admin/v_pertanyaan', $data);
    }

    public function arsipPertanyaan($id_param)
    {
        $temp = $this->model->get_pertanyaan_kode($id_param);
        $kodeTemp = $temp[0]['kode'];
        $success = $this->model->arsip_pertanyaan($id_param);

        if ($success) {
            $message = 'Pertanyaan dengan kode : <b>' . $kodeTemp . '</b> berhasil diarsipkan';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/Pertanyaan'));
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
            return redirect()->to(base_url('Admin/Pertanyaan'));
        }
    }

    public function arsip()
    {
        $data = [
            'judul' => 'Arsip Pertanyaan',
            'pertanyaan' => $this->model->get_pertanyaan_arsip_list()
        ];
        return view('admin/v_pertanyaanArsip', $data);
    }

    public function recoveryPertanyaan($id_param)
    {
        $temp = $this->model->get_pertanyaan_kode($id_param);
        $kodeTemp = $temp[0]['kode'];
        $success = $this->model->recovery_pertanyaan($id_param);

        if ($success) {
            $message = 'Pertanyaan dengan kode : <b>' . $kodeTemp . '</b> berhasil dipulihkan';
            session()->setFlashData('message', $message);
            return redirect()->to(base_url('Admin/Pertanyaan/Arsip'));
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
            return redirect()->to(base_url('Admin/Pertanyaan/Arsip'));
        }
    }

    public function addPertanyaan()
    {
        if (isset($_POST['buttonAddPertanyaan'])) {
            $val = $this->validate([
                'kategori_id_param' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
                'pertanyaan_param' => [
                    'label' => 'Pertanyaan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
                'kunci_param' => [
                    'label' => 'Kunci Jawaban',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'opsi_a_param' => [
                    'label' => 'Opsi A',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'opsi_b_param' => [
                    'label' => 'Opsi B',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'opsi_c_param' => [
                    'label' => 'Opsi C',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'opsi_d_param' => [
                    'label' => 'Opsi D',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ]
            ]);

            if (!$val) {
                session()->setFlashData('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('Admin/Pertanyaan'));
            } else {
                $id_param = uniqid();
                $kode_param = substr(md5(microtime()), rand(0, 26), 5);
                $config['encrypt_name'] = TRUE;

                $folderKategori = [
                    'kategori_id' => $this->request->getPost('kategori_id_param')
                ];
                $folderKategori = $this->modelKategori->get_kategori_kode($folderKategori['kategori_id']);
                $folderKategori = $folderKategori[0]['kode'];

                $gambar_param = $this->request->getFile('gambar_param');
                $audio_param = $this->request->getFile('audio_param');

                if (is_file($gambar_param)) {
                    $nama_gambar =  $gambar_param->getRandomName();
                    $gambar_param->move('assets/img/soal' . '/' . $folderKategori, $nama_gambar);
                } else {
                    $nama_gambar = null;
                }

                if (is_file($audio_param)) {
                    $nama_audio =  $audio_param->getRandomName();
                    $audio_param->move('assets/audio/soal' . '/' . $folderKategori, $nama_audio);
                } else {
                    $nama_audio = null;
                }

                $data = [
                    'pertanyaan_param' => $this->request->getPost('pertanyaan_param'),
                    'kategori_id_param' => $this->request->getPost('kategori_id_param'),
                    'opsi_a_param' => $this->request->getPost('opsi_a_param'),
                    'opsi_b_param' => $this->request->getPost('opsi_b_param'),
                    'opsi_c_param' => $this->request->getPost('opsi_c_param'),
                    'opsi_d_param' => $this->request->getPost('opsi_d_param'),
                    'kunci_param' => $this->request->getPost('kunci_param'),
                    'gambar_param' => $nama_gambar,
                    'audio_param' => $nama_audio
                ];

                $success = $this->model->add_pertanyaan($id_param, $kode_param, $data['pertanyaan_param'], $data['kategori_id_param'], $data['opsi_a_param'], $data['opsi_b_param'], $data['opsi_c_param'], $data['opsi_d_param'], $data['kunci_param'], $data['gambar_param'], $data['audio_param']);

                if ($success) {
                    $message = 'Pertanyaan berhasil ditambahkan';
                    session()->setFlashData('message', $message);
                    return redirect()->to(base_url('Admin/Pertanyaan'));
                }
            }
        } else {
            return redirect()->to(base_url('Admin/Pertanyaan'));
        }
    }

    public function editPertanyaan()
    {
        if (isset($_POST['buttonEditPertanyaan'])) {
            $val = $this->validate([
                'kategori_id_param' => [
                    'label' => 'Kategori',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'pertanyaan_param' => [
                    'label' => 'Pertanyaan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.'
                    ]
                ],
                'kunci_param' => [
                    'label' => 'Kunci Jawaban',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'opsi_a_param' => [
                    'label' => 'Opsi A',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'opsi_b_param' => [
                    'label' => 'Opsi B',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'opsi_c_param' => [
                    'label' => 'Opsi C',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ],
                'opsi_d_param' => [
                    'label' => 'Opsi D',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                    ]
                ]
            ]);

            if (!$val) {
                session()->setFlashData('err', \Config\Services::validation()->listErrors());
                return redirect()->to(base_url('Admin/Pertanyaan'));
            } else {
                $folderKategori = [
                    'kategori_id' => $this->request->getPost('kategori_id_param')
                ];

                $folderKategori = $this->modelKategori->get_kategori_kode($folderKategori['kategori_id']);
                $folderKategori = $folderKategori[0]['kode'];

                $gambar_param = $this->request->getFile('gambar_param');
                $audio_param = $this->request->getFile('audio_param');

                if (is_file($gambar_param)) {
                    $nama_gambar =  $gambar_param->getRandomName();
                    $gambar_param->move('assets/img/soal' . '/' . $folderKategori, $nama_gambar);
                } else {
                    $nama_gambar = $this->request->getPost('old_gambar_param');
                }

                if (is_file($audio_param)) {
                    $nama_audio =  $audio_param->getRandomName();
                    $audio_param->move('assets/audio/soal' . '/' . $folderKategori, $nama_audio);
                } else {
                    $nama_audio = $this->request->getPost('old_audio_param');
                }

                $data = [
                    'id_param' => $this->request->getPost('id_param'),
                    'pertanyaan_param' => $this->request->getPost('pertanyaan_param'),
                    'kategori_id_param' => $this->request->getPost('kategori_id_param'),
                    'opsi_a_param' => $this->request->getPost('opsi_a_param'),
                    'opsi_b_param' => $this->request->getPost('opsi_b_param'),
                    'opsi_c_param' => $this->request->getPost('opsi_c_param'),
                    'opsi_d_param' => $this->request->getPost('opsi_d_param'),
                    'kunci_param' => $this->request->getPost('kunci_param'),
                    'gambar_param' => $nama_gambar,
                    'audio_param' => $nama_audio
                ];

                $success = $this->model->edit_pertanyaan($data['id_param'], $data['pertanyaan_param'], $data['kategori_id_param'], $data['opsi_a_param'], $data['opsi_b_param'], $data['opsi_c_param'], $data['opsi_d_param'], $data['kunci_param'], $data['gambar_param'], $data['audio_param']);

                if ($success) {
                    $message = 'Pertanyaan berhasil diedit';
                    session()->setFlashData('message', $message);
                    return redirect()->to(base_url('Admin/Pertanyaan'));
                }
            }
        } else {
            return redirect()->to(base_url('Admin/Pertanyaan'));
        }
    }

    public function Detail($id_param)
    {
        $data = [
            'judul' => 'Detail Pertanyaan',
            'pertanyaan' => $this->model->get_pertanyaan_detail_by_id($id_param)
        ];

        return view('admin/v_pertanyaanDetail', $data);
    }
}
