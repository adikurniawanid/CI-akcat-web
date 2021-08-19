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

    public function get_pertanyaan_kode($id_param)
    {
        return $this->db->query("call get_pertanyaan_kode('$id_param')")->getresultArray();
    }

    public function add_pertanyaan($id_param, $kode_param, $pertanyaan_param, $kategori_id_param, $opsi_a_param, $opsi_b_param, $opsi_c_param, $opsi_d_param, $kunci, $gambar_param, $audio_param)
    {
        if (is_null($gambar_param)) {
            if (is_null($audio_param)) {
                return $this->db->query("call add_pertanyaan('$id_param','$kode_param', '$pertanyaan_param', '$kategori_id_param', '$opsi_a_param', '$opsi_b_param', '$opsi_c_param', '$opsi_d_param', '$kunci', null, null)");
            }
            return $this->db->query("call add_pertanyaan('$id_param','$kode_param', '$pertanyaan_param', '$kategori_id_param', '$opsi_a_param', '$opsi_b_param', '$opsi_c_param', '$opsi_d_param', '$kunci', null, '$audio_param')");
        } elseif (is_null($audio_param)) {
            return $this->db->query("call add_pertanyaan('$id_param','$kode_param', '$pertanyaan_param', '$kategori_id_param', '$opsi_a_param', '$opsi_b_param', '$opsi_c_param', '$opsi_d_param', '$kunci', '$gambar_param', null)");
        } else {
            return $this->db->query("call add_pertanyaan('$id_param','$kode_param', '$pertanyaan_param', '$kategori_id_param', '$opsi_a_param', '$opsi_b_param', '$opsi_c_param', '$opsi_d_param', '$kunci', '$gambar_param', '$audio_param')");
        }
    }

    public function edit_pertanyaan($id_param, $pertanyaan_param, $kategori_id_param, $opsi_a_param, $opsi_b_param, $opsi_c_param, $opsi_d_param, $kunci, $gambar_param, $audio_param)
    {
        if (is_null($gambar_param)) {
            if (is_null($audio_param)) {
                return $this->db->query("call edit_pertanyaan('$id_param', '$pertanyaan_param', '$kategori_id_param', '$opsi_a_param', '$opsi_b_param', '$opsi_c_param', '$opsi_d_param', '$kunci', null, null)");
            }
            return $this->db->query("call edit_pertanyaan('$id_param', '$pertanyaan_param', '$kategori_id_param', '$opsi_a_param', '$opsi_b_param', '$opsi_c_param', '$opsi_d_param', '$kunci', null, '$audio_param')");
        } elseif (is_null($audio_param)) {
            return $this->db->query("call edit_pertanyaan('$id_param', '$pertanyaan_param', '$kategori_id_param', '$opsi_a_param', '$opsi_b_param', '$opsi_c_param', '$opsi_d_param', '$kunci', '$gambar_param', null)");
        } else {
            return $this->db->query("call edit_pertanyaan('$id_param', '$pertanyaan_param', '$kategori_id_param', '$opsi_a_param', '$opsi_b_param', '$opsi_c_param', '$opsi_d_param', '$kunci', '$gambar_param', '$audio_param')");
        }
    }

    public function get_pertanyaan_list_by_kategori_id($id_param)
    {
        return $this->db->query("call get_pertanyaan_list_by_kategori_id('$id_param')")->getResultArray();
    }

    public function get_pertanyaan_detail_by_id($id_param)
    {
        return $this->db->query("call get_pertanyaan_detail_by_id('$id_param')")->getresultArray();
    }

    public function get_detail_edit_pertanyaan($id_param)
    {
        return $this->db->query("call get_detail_edit_pertanyaan('$id_param')")->getresultArray();
    }
}
