<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pertanyaan extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function get_pertanyaan_list()
    {
        return $this->db->query('call get_pertanyaan_list()')->getResultArray();
    }

    public function get_pertanyaan_arsip_list()
    {
        return $this->db->query('call get_pertanyaan_arsip_list()')->getResultArray();
    }

    public function delete_pertanyaan($id_param)
    {
        return $this->db->query("call delete_pertanyaan('$id_param')");
    }

    public function arsip_pertanyaan($id_param)
    {
        return $this->db->query("call arsip_pertanyaan('$id_param')");
    }

    public function recovery_pertanyaan($id_param)
    {
        return $this->db->query("call recovery_pertanyaan('$id_param')");
    }

    public function get_pertanyaan_kode($id_param)
    {
        return $this->db->query("call get_pertanyaan_kode('$id_param')")->getresultArray();
    }
}
