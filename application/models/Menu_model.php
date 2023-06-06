<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public function deleteUser($where = null)
    {
        $this->db->delete('user_menu', $where);
    }
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id` = `user_menu`.`id`";
        return $this->db->query($query)->result_array();
    }

    public function joinCertFull($userEm)
    {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user.email', $userEm);
        $this->db->join('user_certificate', 'user.id = user_certificate.user_id', 'LEFT');
        $query1 = $this->db->get_compiled_select();

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user.id', $userEm);
        $this->db->join('user_certificate', 'user.id = user_certificate.user_id', 'RIGHT');
        $query2 = $this->db->get_compiled_select();

        $query = $query1 . ' UNION ' . $query2;

        $result = $this->db->query($query);
        return $result->result();
    }
}
