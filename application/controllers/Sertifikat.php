<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikat extends CI_Controller
{
    // Mencegah masuk controller tanpa session
    public function __construct()
    {
        parent::__construct();
        is_logged_in(); //function helper
    }

    public function index()
    {
        $data['title'] = 'Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['certificate'] = $this->db->get_where('user_certificate', ['email' => $this->session->userdata('email')])->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('sertifikat/index', $data);
            $this->load->view('templates/v_footer');
        }
    }
}
