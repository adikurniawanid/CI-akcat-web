<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;

class Login extends BaseController
{
	public function index()
	{
		$data = [
			'judul' => 'Login'
		];
		echo view('templates/v_header', $data);
		echo view('login/v_login');
	}

	public function login()
	{
		return redirect()->to(base_url('Admin/dashboard'));
	}
}
