<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Menu extends CI_Controller
{

    // Mencegah masuk controller tanpa session
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model');
    }
    // public function deleteUser()
    // {
    //     $this->load->model('menu_model', 'menumo');
    //     $where = ['id' => $this->uri->segment(3)];
    //     $this->menumo->deleteUser($where);
    //     redirect('menu');
    // }

    public function index()
    {
        $data['title'] = 'Sertifikat Pelatihan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $userEm = $this->session->userdata('email');
        $data['result'] = $this->Menu_model->joinCertFull($userEm);
        $this->form_validation->set_rules('user_id', 'User ID', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/v_footer');
        }
    }
}
