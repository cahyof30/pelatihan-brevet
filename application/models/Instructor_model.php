<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instructor_model extends CI_Model
{

    public function deleteMaterial($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function deleteExam($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function deleteExamScore($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function getMaterial()
    {
        $query = "SELECT `user_material`.*, `user_course`.`course`
        FROM `user_material` JOIN `user_course`
        ON `user_material`.`course_id` = `user_course`.`id`
        ";
        return $this->db->query($query)->result_array();
    }

    public function course()
    {
        $this->db->get('user_course');
    }

    public function material($where)
    {
        $this->db->select('url');
        $this->db->from('user_material');
        $this->db->where($where);
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

    public function materi()
    {
        $this->db->order_by('id');
        return $this->db->get('user_material')->result();
    }
    public function joinCourse($where)
    {
        $this->db->from('user_material');
        $this->db->join('user_course', 'user_course.course_id = user_material.course_id');
        $this->db->where($where);
        return $this->db->get();
    }
    public function joinExamCourse($where)
    {
        $this->db->from('user_exam');
        $this->db->join('user_course', 'user_course.course_id = user_exam.course_id');
        $this->db->where($where);
        return $this->db->get();
    }
    public function joinExamType($where)
    {
        $this->db->from('user_exam');
        $this->db->join('user_exam_type', 'user_exam_type.exam_tp = user_exam.exam_tp');
        $this->db->where($where);
        return $this->db->get();
    }
    public function joinExamStatus($where)
    {
        $this->db->from('user_exam_score');
        $this->db->join('user_status', 'user_status.status_id = user_exam_score.status_id');
        $this->db->where($where);
        return $this->db->get();
    }

    public function getExamResult()
    {
        return $this->db->get('user_exam_upload');
    }
    public function getCourse()
    {
        return $this->db->get('user_course');
    }
    public function getExamType()
    {
        return $this->db->get('user_exam_type');
    }
    public function getStatus()
    {
        return $this->db->get('user_status');
    }
    public function getCourseWhere($where = null)
    {
        return $this->db->get_where('user_material', $where);
    }
    public function getExamWhere($where)
    {
        return $this->db->get_where('user_exam', $where);
    }
    public function getExamScoreWhere($where)
    {
        return $this->db->get_where('user_exam_score', $where);
    }
    public function tampil_materi()
    {
        return $this->db->get('user_material');
    }
    public function getExam()
    {
        return $this->db->get('user_exam');
    }
    public function simpanExam($data = null)
    {
        $this->db->insert('user_exam', $data);
    }
    public function simpanMateri($data = null)
    {
        $this->db->insert('user_material', $data);
    }
    public function simpanExamScore($data = null)
    {
        $this->db->insert('user', $data);
    }


    public function editCourse($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function updateCourse($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function updateMateri($data = null, $where = null)
    {
        $this->db->update('user_material', $data, $where);
    }
    public function updateExam($data = null, $where = null)
    {
        $this->db->update('user_exam', $data, $where);
    }
    public function updateExamScore($data = null, $where = null)
    {
        $this->db->update('user_exam_score', $data, $where);
    }
    public function updateRole($data2 = null, $where = null)
    {
        $this->db->update('user', $data2, $where);
    }
    public function joinExam()
    {
        $this->db->select('*');
        $this->db->from('user_exam');
        $this->db->join('user_course', 'user_course.course_id = user_exam.course_id');
        $this->db->join('user_exam_type', 'user_exam_type.exam_tp = user_exam.exam_tp');
        return $this->db->get();
    }
    public function displayExamScore()
    {
        $this->db->select('*');
        $this->db->from('user_exam_score');
        return $this->db->get();
    }
    public function joinExamWhere($where)
    {
        $this->db->select('*');
        $this->db->from('user_exam');
        $this->db->where($where);
        $this->db->join('user_course', 'user_course.id = user_exam.course_id');
        $this->db->join('user_exam_type', 'user_exam_type.id = user_exam.exam_id');
        return $this->db->get();
    }
}
