<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{


    public function simpanData($data = null)
    {
        $this->db->insert('user', $data);
    }

    public function cekData($where = null)
    {
        return $this->db->get_where('user', $where);
    }

    public function getUserWhere($where = null)
    {
        return $this->db->get_where('user', $where);
    }

    public function getUser()
    {
        return $this->db->get('user');
    }
    public function getExam()
    {
        return $this->db->get('user_exam_upload');
    }

    public function cekUserAccess($where = null)
    {
        $this->db->select('*');
        $this->db->from('access_menu');
        $this->db->where($where);
        return $this->db->get();
    }

    public function getUserLimit()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->limit(10, 0);
        return $this->db->get();
    }
    public function deleteUser($where = null)
    {
        $this->db->delete('user', $where);
    }

    public function getRole()
    {
        $query = "SELECT `user`.*, `user_role`.`role`
        FROM `user` JOIN `user_role`
        ON `user`.`role_id` = `user_role`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function jumlah_user()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role_id', 2);
        return $this->db->get()->num_rows();
    }

    public function data_peserta()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role_id', 2);
        return $this->db->get()->result_array();
    }


    public function data_instruktur()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role_id', 3);
        return $this->db->get()->result_array();
    }

    public function user_wait()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('verified', 0);

        return $this->db->get()->num_rows();
    }

    public function user_verified()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('verified', 1);
        $this->db->where('role_id', 2);

        return $this->db->get()->num_rows();
    }

    public function jumlah_instruktur()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role_id', 3);

        return $this->db->get()->num_rows();
    }

    // public function userdetail($where)
    // {
    //     $this->db->from('user');
    //     $this->db->where($where);
    //     return $this->db->get();
    // }
    public function updateProfile($data = null, $where = null)
    {
        $this->db->update('user', $data, $where);
    }

    public function current_user()
    {

        $id = $this->session->userdata('id');
        $query = $this->db->get_where($this->_table, ['id' => $id]);
        return $query->row();
    }
    public function cekModul()
    {
        $this->db->select('*');
        $this->db->from('user_material');
        $this->db->where('modul', NULL);
        return $this->db->get();
    }
    public function joinDisplayMateri()
    {
        $this->db->select('user_material.*, user_course.course_id AS course_id, user_course.course');
        $this->db->join('user_course', 'user_course.course_id = user_material.course_id');
        $this->db->from('user_material');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function joinDisplayExam()
    {
        $this->db->select('user_exam.*, user_course.course_id AS course_id, user_course.course');
        $this->db->join('user_course', 'user_course.course_id = user_material.course_id');
        $this->db->from('user_material');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function joinExamWhere($where)
    {
        $this->db->select('*');
        $this->db->from('user_exam');
        $this->db->where($where);
        $this->db->join('user_course', 'user_course.course_id = user_exam.course_id');
        $this->db->join('user_exam_type', 'user_exam_type.exam_tp = user_exam.exam_tp');
        return $this->db->get();
    }


    public function joinExamUp()
    {
        $query = $this->db->query('
        SELECT *
            FROM user
            LEFT JOIN user_exam_upload ON user.id = user_exam_upload.user_id
            UNION
            SELECT *
            FROM user
            RIGHT JOIN user_exam_upload ON user.id = user_exam_upload.user_id');
        return $query->result_array();

        // $user_id = $this->session->userdata('id');
        // $this->db->select('*');
        // $this->db->from('user');
        // $this->db->join('user_exam_upload', 'user.id = user_exam_upload.user_id');
        // $this->db->where('user_exam_upload.user_id', $user_id);
        // return $this->db->get()->result_array();
    }
    public function joinExamUpWhere($where)
    {
        $query1 = $this->db->select('*')
                           ->from('user')
                           ->where('id', $where)
                           ->get()->result_array();

        $query2 = $this->db->select('*')
                           ->from('user_exam_upload')
                           ->where('user_id', $where)
                           ->get()->result_array();

        $query = array_merge($query1, $query2);;

        return $query;

        // $user_id = $this->session->userdata('id');
        // $this->db->select('*');
        // $this->db->from('user');
        // $this->db->join('user_exam_upload', 'user.id = user_exam_upload.user_id');
        // $this->db->where('user_exam_upload.user_id', $user_id);
        // return $this->db->get()->result_array();
    }

    public function updateBuktibayar($data = null, $where = null)
    {
        $this->db->update('user', $data, $where);
    }
    // public function getDataById($id) {
    //     // $this->db->from('user_exam_upload');
    //     $this->db->where('user_id', $id);
    //     $query = $this->db->get('user_exam_upload'); 
    //     return $query->result_array();
    // }
    // public function insertExamFile($data = null, $where = null)
    // {
    //     $this->db->insert('user_exam_upload', $data, $where);
    // }
    public function updateExamFile($data = null, $where = null)
    {
        $this->db->update('user_exam_upload', $data, $where);
    }
    public function getExamWhere($where)
    {
        return $this->db->get_where('user_exam', $where);
    }
    public function getExamUpload($where)
    {
        return $this->db->get_where('user_exam_upload', $where);
    }
    public function simpanMidExam($data = null)
    {
        $this->db->insert('user_exam_upload', $data);
    }
    public function getExamScoreWhere($where)
    {
        return $this->db->get_where('user_exam_score', $where);
    }
    

}
