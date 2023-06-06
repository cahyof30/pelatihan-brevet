<?php
class Certificate_model extends CI_Model
{
    public function getCertificateData()
    {
        $certificate_id = $this->session->userdata('email');
        // Query database untuk mengambil data sertifikat berdasarkan ID sertifikat
        $query = $this->db->get_where('user_certificate', array('email' => $certificate_id));
        return $query->row_array();
    }
}
