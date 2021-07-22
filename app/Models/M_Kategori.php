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

    public function get_kategori_arsip_list()
    {
        return $this->db->query('call get_kategori_arsip_list()')->getResultArray();
    }

    public function add_kategori($id_param, $kode_param, $nama_param, $nilai_param)
    {
        return $this->db->query("call add_kategori('$id_param','$kode_param', '$nama_param', $nilai_param)");
    }

    public function delete_kategori($id_param)
    {
        return $this->db->query("call delete_kategori('$id_param')");
    }

    public function arsip_kategori($id_param)
    {
        return $this->db->query("call arsip_kategori('$id_param')");
    }

    public function recovery_kategori($id_param)
    {
        return $this->db->query("call recovery_kategori('$id_param')");
    }

    public function get_kategori_name($id_param)
    {
        return $this->db->query("call get_kategori_name('$id_param')")->getresultArray();
    }

    public function get_kategori_kode($id_param)
    {
        return $this->db->query("call get_kategori_kode('$id_param')")->getresultArray();
    }

    public function edit_kategori($id_param, $nama_param, $nilai_param)
    {
        return $this->db->query("call edit_kategori('$id_param', '$nama_param', $nilai_param)");
    }

    public function get_jumlah_soal_by_kategori($id_param)
    {
        return $this->db->query("call get_jumlah_soal_by_kategori('$id_param')")->getresultArray();
    }
}
