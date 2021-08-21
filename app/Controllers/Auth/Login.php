<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\M_Auth;

class Login extends BaseController
{

	public function __construct()
	{
		$this->model = new M_Auth();
	}

	public function index()
	{
		if (isset($_SESSION['user_id'])) {
			return redirect()->to(base_url('Admin'));
		}
		session()->destroy();
		$data = [
			'judul' => 'Login'
		];
		echo view('templates/admin/v_header', $data);
		echo view('auth/v_login');
	}

	public function login()
	{
		if (isset($_POST['buttonLogin'])) {
			$val = $this->validate([
				'email_username_param' => [
					'label' => 'Email atau Username',
					'rules' => 'required|max_length[50]',
					'errors' => [
						'required' => '{field} tidak boleh kosong.',
						'max_length' => '{field} tidak boleh lebih dari 100 huruf.'
					]

				],
				'password_param' => [
					'label' => 'Password',
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong.'
					]
				]
			]);

			if (!$val) {
				session()->setFlashData('err', \Config\Services::validation()->listErrors());
				return redirect()->to(base_url('Auth/Login'));
			} else {
				$data = [
					'email_username_param' => $this->request->getPost('email_username_param'),
					'password_param' => $this->request->getPost('password_param')
				];

				$isUsernameExist = $this->model->is_username_exist($data['email_username_param']);

				if ($isUsernameExist == 1) {
					$usernameEmailExist = true;
				} else {
					$isEmailExist = $this->model->is_email_exist($data['email_username_param']);
					if ($isEmailExist == 1) {
						$usernameEmailExist = true;
					} else {
						$message = 'Email atau Username salah';
						session()->setFlashData('err', $message);
						return redirect()->to(base_url('Auth/Login'));
					}
				}

				if ($usernameEmailExist == true) {

					$status = $this->model->get_user_status($data['email_username_param']);

					if ($status == 0) {
						$passwordHash = $this->model->get_password_hash($data['email_username_param']);

						if (password_verify($data['password_param'], $passwordHash)) {
							$success = true;
							$role = $this->model->get_user_role($data['email_username_param']);
						} else {
							$success = false;
						}

						session()->set('user_id', $this->model->get_user_id_by_username_email($data['email_username_param']));
						$user_information = $this->model->get_user_information($this->session->get('user_id'));
						session()->set('nama', $user_information['nama']);
						session()->set('email', $user_information['email']);
						session()->set('jenisKelaminId', $user_information['jenis_kelamin_id']);
						session()->set('noHp', $user_information['no_hp']);
						session()->set('instansi', $user_information['instansi']);

						if ($success && $role == 1) {
							return redirect()->to(base_url('Admin'));
						} elseif ($success && $role == 2) {
							return redirect()->to(base_url('user'));
						} else {
							$message = 'Password yang diinput salah';
							session()->setFlashData('err', $message);
							return redirect()->to(base_url('Auth/Login'));
						}
					} elseif ($status == 1) {
						$message = 'User Telah dinonaktifkan';
						session()->setFlashData('err', $message);
						return redirect()->to(base_url('Auth/Login'));
					} else {
						$message = 'User Telah dinonaktifkan. Silahkan hubungi admin';
						session()->setFlashData('err', $message);
						return redirect()->to(base_url('Auth/Login'));
					}
				}
			}
		} else {
			return redirect()->to(base_url('Auth/Login'));
		}
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to(base_url('Auth/Login'));
	}
}
