<?php

namespace App\Models;

use CodeIgniter\Model;

class M_SesiUjian extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function get_sesi_ujian_list()
    {
        return $this->db->query('call get_sesi_ujian_list()')->getResultArray();
    }

    public function get_sesi_ujian_arsip_list()
    {
        return $this->db->query('call get_sesi_ujian_arsip_list()')->getResultArray();
    }

    public function add_sesi_ujian($id_param, $kode_param, $nama_param, $lokasi_param, $waktu_mulai_param, $durasi_param)
    {
        return $this->db->query("call add_sesi_ujian('$id_param','$kode_param', '$nama_param', '$lokasi_param', '$waktu_mulai_param', $durasi_param)");
    }

    public function edit_sesi_ujian($id_param, $nama_param, $lokasi_param, $waktu_mulai_param, $durasi_param)
    {
        return $this->db->query("call edit_sesi_ujian('$id_param', '$nama_param', '$lokasi_param', '$waktu_mulai_param', $durasi_param)");
    }

    public function get_sesi_ujian_name($id_param)
    {
        return $this->db->query("call get_sesi_ujian_name('$id_param')")->getresultArray();
    }

    public function arsip_sesi_ujian($id_param)
    {
        return $this->db->query("call arsip_sesi_ujian('$id_param')");
    }

    public function delete_sesi_ujian($id_param)
    {
        return $this->db->query("call delete_sesi_ujian('$id_param')");
    }

    public function recovery_sesi_ujian($id_param)
    {
        return $this->db->query("call recovery_sesi_ujian('$id_param')");
    }
}
