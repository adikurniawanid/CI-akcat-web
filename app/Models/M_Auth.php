<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Auth extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
    }

    public function verify_login($email_username_param, $password_param)
    {
        return $this->db->query("verify_login('$email_username_param', '$password_param')");
    }

    public function get_password_hash($email_username_param)
    {
        return $this->db->query("call get_password_hash('$email_username_param')")->getRow()->RESULT;
    }

    public function is_username_exist($username_param)
    {
        return $this->db->query("call is_username_exist('$username_param')")->getRow()->RESULT;
    }

    public function is_email_exist($email_param)
    {
        return $this->db->query("call is_email_exist('$email_param')")->getRow()->RESULT;
    }

    public function get_user_information($id_param)
    {
        return $this->db->query("call get_user_information('$id_param')")->getRowArray();
    }

    public function get_user_status($email_username_param)
    {
        return $this->db->query("call get_user_status('$email_username_param')")->getRow()->RESULT;
    }

    public function get_user_role($email_username_param)
    {
        return $this->db->query("call get_user_role('$email_username_param')")->getRow()->RESULT;
    }

    public function get_jumlah_peserta()
    {
        return $this->db->query("call get_jumlah_peserta()")->getRow()->RESULT;
    }

    public function get_jumlah_kategori()
    {
        return $this->db->query("call get_jumlah_kategori()")->getRow()->RESULT;
    }

    public function get_jumlah_pertanyaan()
    {
        return $this->db->query("call get_jumlah_pertanyaan()")->getRow()->RESULT;
    }

    public function get_jumlah_sesi()
    {
        return $this->db->query("call get_jumlah_sesi_ujian()")->getRow()->RESULT;
    }

    public function get_user_id_by_username_email($email_username_param)
    {
        return $this->db->query("call get_user_id_by_username_email('$email_username_param')")->getRow()->RESULT;
    }
}
