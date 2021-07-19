<?php

namespace App\Controllers;

class Home extends BaseController
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
		echo view('admin/v_dashboard');
	}
}
