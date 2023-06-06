<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verification_model extends CI_Model
{

public function getUnverifiedUsers()
    {
        $this->db->where('verified', 0);
        $this->db->where('date_created <=', date('Y-m-d H:i:s', strtotime('-7 days'))); // Tenggat waktu 7 hari
        $query = $this->db->get('user'); // Ganti dengan nama tabel pengguna sesuai struktur Anda
        return $query->result();
    }

    public function expireUsers($userID)
    {
        $this->db->where('id', $userID);
        $this->db->delete('user'); 
    }

}