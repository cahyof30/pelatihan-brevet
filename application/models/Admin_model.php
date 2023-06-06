<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function deleteUser($where = null)
    {
        $this->db->delete('user', $where);
    }

    public function get_bb()
    {
        $where = $this->uri->segment(3);
        $this->db->select('buktibayar');
        $this->db->from('user'); // Gantilah "nama_tabel" dengan nama tabel Anda
        // Tambahkan kondisi jika diperlukan
        // $this->db->where('kondisi', 'nilai_kondisi');
        $this->db->where('id', $where);
        $query = $this->db->get();
        $result = $query->row();

        if ($result) {
            return base_url('images/bukti_bayar/' . $result->buktibayar); // Gantilah "path_gambar" dengan path direktori gambar Anda
        } else {
            return ''; // Jika gambar tidak ditemukan, Anda dapat mengembalikan nilai kosong atau menangani sesuai kebutuhan aplikasi Anda
        }
    }

    public function copyToExamUpload()
    {
        $query = $this->db->query('INSERT INTO user_exam_upload (user_id, name)
        SELECT id, name FROM user');
        return $query;
    }

    public function getRole()
    {
        $query = "SELECT `user`.*, `user_role`.`role`
        FROM `user` JOIN `user_role`
        ON `user`.`role_id` = `user_role`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function verifyUser($user = 'user.verified')
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('verified', 0);
        $sql = "UPDATE user SET user.verified=user.verified+1 WHERE user.id=user.id AND user.verified = $user";
        $this->db->query($sql);
    }

    public function getCert()
    {
        $this->db->select('*');
        $this->db->from('user_certificate');
        return $this->db->get();

        // return $this->db->query(
        //     "SELECT uc.user_id, u.name, u.email, uc.certificate 
        //     FROM user_certificate uc 
        //     LEFT JOIN user u ON uc.user_id = u.id 
        //     WHERE u.status_id = 1;"
        // );
    }

    public function getCertWhere($where)
    {
        return $this->db->get_where('user_certificate', $where);
    }

    public function deleteCert($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function updateCert($data = null, $where = null)
    {
        $this->db->update('user_certificate', $data, $where);
    }
    public function displayInstructor()
    {
        return $this->db->get('user');
    }

    public function data_instruktur()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role_id', 3);
        return $this->db->get()->result_array();
    }

    public function updateUser($data = null, $where = null)
    {
        $this->db->update('user', $data, $where);
    }

    public function getUserWhere($where = null)
    {
        return $this->db->get_where('user', $where);
    }

    public function data_alumni()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role_id', 4);
        return $this->db->get()->result_array();
    }
    public function displayCert()
    {
        $this->db->select('*');
        $this->db->from('user_certificate');
        return $this->db->get();
    }

    public function countEmptyCert()
    {
        $query = ("SELECT COUNT(*) as count FROM user_certificate WHERE certificate = ''");
        $result = $this->db->query($query)->row();
    }
}
