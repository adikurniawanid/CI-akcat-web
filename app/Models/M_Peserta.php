<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Peserta extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function get_peserta_list()
    {
        return $this->db->query('call get_peserta_list()')->getResultArray();
    }

    public function get_peserta_arsip_list()
    {
        return $this->db->query('call get_peserta_arsip_list()')->getResultArray();
    }

    public function delete_peserta($id_param)
    {
        return $this->db->query("call delete_peserta('$id_param')");
    }

    public function recovery_peserta($id_param)
    {
        return $this->db->query("call recovery_peserta('$id_param')");
    }

    public function get_peserta_name($id_param)
    {
        return $this->db->query("call get_peserta_name('$id_param')")->getresultArray();
    }

    public function arsip_peserta($id_param)
    {
        return $this->db->query("call arsip_peserta('$id_param')");
    }

    public function add_peserta(
        $id_param,
        $username_param,
        $email_param,
        $password_param,
        $nama_param,
        $jenis_kelamin_id_param,
        $no_hp_param,
        $instansi_param
    ) {
        return $this->db->query("call add_peserta('$id_param',
        '$username_param',
        '$email_param',
        '$password_param',
        '$nama_param',
        '$jenis_kelamin_id_param',
        '$no_hp_param',
        '$instansi_param')");
    }

    public function edit_peserta(
        $id_param,
        $email_param,
        $password_param,
        $nama_param,
        $jenis_kelamin_id_param,
        $no_hp_param,
        $instansi_param
    ) {
        return $this->db->query("call edit_peserta('$id_param',
        '$email_param',
        '$password_param',
        '$nama_param',
        '$jenis_kelamin_id_param',
        '$no_hp_param',
        '$instansi_param')");
    }

    public function get_jenis_kelamin_list()
    {
        return $this->db->query('call get_jenis_kelamin_list()')->getResultArray();
    }
}
