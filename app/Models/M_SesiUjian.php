<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SesiUjian extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function get_sesi_ujian_aktif_list()
    {
        return $this->db->query('call get_sesi_ujian_aktif_list()')->getResultArray();
    }

    public function get_sesi_ujian_arsip_list()
    {
        return $this->db->query('call get_sesi_ujian_arsip_list()')->getResultArray();
    }
}
