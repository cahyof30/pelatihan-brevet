<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require_once APPPATH . 'libraries\tcpdf\tcpdf.php';
// require_once dirname(__FILE__) . '\libraries\tcpdf\tcpdf.php';

class Certificate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        // Load model dan library yang diperlukan
        // $this->load->model('Certificate_model');
        // $this->load->library('pdf');
    }

    public function index()
    {
        $data['title'] = 'Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['certificate'] = $this->db->get_where('user_certificate', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('certificate/index', $data);
            $this->load->view('templates/v_footer');
        }
    }
}
