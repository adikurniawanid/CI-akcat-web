<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\M_User;


class Home extends BaseController
{
    public function __construct()
    {
        $this->model = new M_User();
    }
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            return redirect()->to(base_url('Auth/Login'));
        }

        $data = [
            'judul' => 'Dashboard',
            'sesi' => $this->model->get_sesi_ujian_user_list(session()->get('user_id'))
        ];

        return view('user/index', $data);
    }

    public function joinSesi()
    {
        if (isset($_POST['buttonJoinSesi'])) {
            $val = $this->validate([
                'kode_param' => [
                    'label' => 'Kode Sesi',
                    'rules' => 'required|max_length[5]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong.',
                        'max_length' => '{field} tidak boleh lebih dari 5 karakter.'
                    ]
                ]
            ]);
            $result = $this->model->is_ujian_exist($this->request->getPost('kode_param'));
            if ($result) {
                if (!$val) {
                    session()->setFlashData('err', \Config\Services::validation()->listErrors());
                    return redirect()->to($_SERVER['HTTP_REFERER']);
                } else {
                    $no_peserta = substr(md5(microtime()), rand(0, 26), 5);

                    $data = [
                        'kode_param' => $this->request->getPost('kode_param')
                    ];

                    $user_id = session()->get('user_id');

                    $registered = $this->model->is_registered_peserta_ujian($data['kode_param'], $user_id);
                    $registered = $registered['RESULT'];

                    if (!$registered) {
                        $success = $this->model->add_peserta_ujian($no_peserta, $user_id, $data['kode_param']);
                        if ($success) {
                            $message = 'Kode Sesi berhasil digunakan';
                            session()->setFlashData('message', $message);
                            return redirect()->to($_SERVER['HTTP_REFERER']);
                        }
                    } else {
                        $message = 'Kode sesi telah didaftarkan';
                        session()->setFlashData('err', $message);
                        return redirect()->to($_SERVER['HTTP_REFERER']);
                    }
                }
            } else {
                $message = 'Kode Sesi tidak valid';
                session()->setFlashData('err', $message);
                return redirect()->to($_SERVER['HTTP_REFERER']);
            }
        } else {
            return redirect()->to($_SERVER['HTTP_REFERER']);
        }
    }
}
