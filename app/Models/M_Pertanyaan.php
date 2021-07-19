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
}
