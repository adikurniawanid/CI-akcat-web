<?php

namespace App\Models;

use CodeIgniter\Model;

class M_User extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function add_peserta_ujian($no_peserta_param, $peserta_id_param, $kode_param)
    {
        return $this->db->query("call add_peserta_ujian('$no_peserta_param', '$peserta_id_param', '$kode_param')");
    }

    public function is_ujian_valid($is_ujian_valid)
    {
        return $this->db->query("call is_ujian_valid('$is_ujian_valid')")->getResultArray();
    }

    public function is_ujian_exist($kode_param)
    {
        return $this->db->query("call is_ujian_exist('$kode_param')")->getRowArray();
    }

    public function is_registered_peserta_ujian($kode_param, $user_id_param)
    {
        return $this->db->query("call is_registered_peserta_ujian('$kode_param', '$user_id_param')")->getRowArray();
    }

    public function get_sesi_ujian_user_list($user_id_param)
    {
        return $this->db->query("call get_sesi_ujian_user_list('$user_id_param')")->getResultArray();
    }
}
