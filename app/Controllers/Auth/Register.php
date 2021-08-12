<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\M_Peserta;
use App\Models\M_Register;
use CodeIgniter\Config\Services;
use CodeIgniter\Database\Config;

class Register extends BaseController
{
    public function __construct()
    {
        $this->model = new M_Register();
        $this->modelPeserta = new M_Peserta();
    }

    public function index()
    {
        $data = [
            'judul' => 'Register',
            'jenisKelamin' => $this->modelPeserta->get_jenis_kelamin_list()
        ];
        echo view('templates/v_header', $data);
        echo view('auth/v_register');
    }

    // public function register()
    // {
    //     if (!$this->validate([
    //         'nama' => 'required',
    //         // 'username' => 'required' | 'is_unique[peserta.username]',
    //         // 'email' => 'required' | 'is_unique[peserta.email]',
    //         // 'instansi' => 'required',
    //         // 'noHp' => 'required', 'jenisKelamin' => 'required',
    //         // 'password' => 'required', 'retypePassword' => 'required'
    //     ])) {
    //         $validation = \Config\Services::validation();
    //         $data['validation'] = $validation;
    //         return redirect()->to(base_url('Auth/Register'))->withInput()->with('validation', $validation);
    //     } else {
    //         echo "ayo";
    //     }
    // }
}
