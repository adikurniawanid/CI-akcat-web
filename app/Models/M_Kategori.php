<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Kategori extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function get_kategori_list()
    {
        return $this->db->query('call get_kategori_list()')->getResultArray();
    }

    public function add_kategori($data)
    {
        $id_param = uniqid();
        return $this->db->callFunction('call add_kategori', $id_param, $data['nama_param'], $data['nilai_param']);
    }
}
