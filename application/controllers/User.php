<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    // definisikan helper utk mencegah masuk controller tanpa session
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/v_header', $data);
        $this->load->view('templates/v_sidebar', $data);
        $this->load->view('templates/v_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/v_footer');
    }

    public function profile()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('User_model', 'dashboard');
        $data['dashboard'] = $this->dashboard->getRole();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('user/profile', $data);
            $this->load->view('templates/v_footer');
        }
    }

    // function edit data user
    public function edit()
    {
        $data['title'] = 'Edit Profil';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|trim|numeric|regex_match[/^\d{10,13}$/]');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan Terakhir', 'required|trim');
        $this->form_validation->set_rules('domisili', 'Domisili', 'required|trim');

        // konfigurasi upload image
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '2048';
        $config['upload_path']   = './assets/images/profile/';
        $config['file_name']     = time();
        $this->load->library('upload', $config);

        $name = $this->input->post('name');
        $no_hp = $this->input->post('no_hp');
        $pendidikan = $this->input->post('pendidikan');
        $domisili = $this->input->post('domisili');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/v_footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $img = $this->upload->data();
                $new_img = $img['file_name'];
                if ($this->input->post('old_img', TRUE) != 'default.jpg'){
                unlink('assets/images/profile/' . $this->input->post('old_img', TRUE));
            }
                 } else {
                $new_img = $this->input->post('old_img', TRUE);
                }
                
            $data = 
            [
                'name' => $name,
                'image' => $new_img,
                'no_hp' => $no_hp,
                'pendidikan' => $pendidikan,
                'domisili' => $domisili
            ];

            // $this->db->set('name', $name);
            // $this->db->where('email', $email);
            // $this->db->update('user');
            $this->User_model->updateProfile($data, ['id' => $this->input->post('id')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your profile has been updated!</div>');
            redirect('user/profile');
        }
    }

    // function ubah password
    public function chpasswd()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Rules ubah password
        $this->form_validation->set_rules('currentpassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newpassword1', 'New Password', 'required|trim|min_length[8]|matches[newpassword2]');
        $this->form_validation->set_rules('newpassword2', 'Confirm New Password', 'required|trim|min_length[8]|matches[newpassword1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('user/chpasswd', $data);
            $this->load->view('templates/v_footer');
        } else {

            // password salah
            $currentpassword = $this->input->post('currentpassword');
            $newpassword = $this->input->post('newpassword1');
            if (!password_verify($currentpassword, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Wrong Current Password!!</div>');
                redirect('user/chpasswd');
            } else {
                // password tidakboleh sama
                if ($currentpassword == $newpassword) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New Password cannot be the same as Current Password!!</div>');
                    redirect('user/chpasswd');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($newpassword, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Berhasil Diubah!</div>');
                    redirect('user/chpasswd');
                }
            }
        }
    }

    public function v_course()
    {
        $data['title'] = 'Materi Pelatihan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['materi'] = $this->Instructor_model->joinDisplayMateri();
        $data['course'] = $this->db->get('user_course')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('user/v_course', $data);
            $this->load->view('templates/v_footer');
        }
    }

    public function downloadModul($id)
    {
        $data = $this->db->get_where('user_material', ['id' => $id])->row();
        if ($data == TRUE) {
            force_download('modul/' . $data->modul, NULL);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Terjadi Kesalahan, modul tidak dapat diunduh!</div>');
            redirect('user/v_course');
        }
    }

    public function v_exam()
    {
        $data['title'] = 'Ujian Pelatihan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['exam'] = $this->Instructor_model->joinExam()->result_array();


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('user/v_exam', $data);
            $this->load->view('templates/v_footer');
        }
    }


    public function uploadbb()
    {
        $data['title'] = 'Upload Bukti Bayar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size']      = '2048';
        $config['upload_path']   = './assets/images/bukti_bayar';
        $config['file_name']     = time();
        $this->load->library('upload', $config);

        $name = $this->input->post('name');
        $email = $this->input->post('email');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('user/uploadbb', $data);
            $this->load->view('templates/v_footer');
        } else {
            if ($this->upload->do_upload('buktibayar')) {
                    $bukti = $this->upload->data();
                    $new_bb = $bukti['file_name'];
                    if ($this->input->post('old_bb', TRUE) != 'nodata.png'){
                    unlink('assets/images/bukti_bayar/' . $this->input->post('old_bb', TRUE));}
                } else {
                    $new_bb = $this->input->post('old_bb', TRUE);
                }
            
                $data =[
                    'name' => $name,
                    'email' => $email,
                    'buktibayar' => $new_bb
                ];

            // $this->db->set('name', $name);
            // $this->db->where('email', $email);
            // $this->db->update('user');

            $this->User_model->updateBuktibayar($data, ['id' => $this->input->post('id')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Your profile has been updated!</div>');
            redirect('user/profile');
        }
    }

    public function uploadMidExam()
    {
        $data['title'] = 'Upload Jawaban Mid Test';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['users'] = $this->db->get_where('user_exam_upload', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('id', 'User ID', 'required', ['required' => "User ID harus diisi!"]);
        // $this->form_validation->set_rules('name', 'Name', 'required', ['required' => "Name harus diisi!"]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './exam/answer/';
        $config['allowed_types'] = 'pdf|rar|zip';
        $config['max_size'] = '10000';
        $config['file_name'] = 'MidExam' . time();

        $this->load->library('upload', $config);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('user/uploadMidExam', $data);
            $this->load->view('templates/v_footer');
        } else {
            if ($this->upload->do_upload('midexam_file')) {
                $mid = $this->upload->data();
                unlink('/exam/answer/' . $this->input->post('old_ans', TRUE));
                $midexam = $mid['file_name'];
            } else {
                $midexam = $this->input->post('old_ans', TRUE);
            }
            $data = [
                'user_id' => $this->input->post('id', true),
                'email' => $this->input->post('email', true),
                'midexam_file' => $midexam
            ];
            $this->User_model->updateExamFile($data, ['user_id' => $this->input->post('id')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jawaban Anda Berhasil diunggah!</div>');
            // $cekData = $this->User_model->getDataById($data['user_id']);

            // if($cekData) {

            // } else {
            //     $this->User_model->insertExamFile($data, ['user_id' => $this->input->post('id')]);
            //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jawaban Anda Berhasil diunggah!</div>');
            // }          
            redirect('user/v_exam');
        }
    }
    public function uploadFinalExam()
    {
        $data['title'] = 'Upload Jawaban Final Test';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['users'] = $this->db->get_where('user_exam_upload', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('id', 'User ID', 'required', ['required' => "User ID harus diisi!"]);
        // $this->form_validation->set_rules('name', 'Name', 'required', ['required' => "Name harus diisi!"]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './exam/answer/';
        $config['allowed_types'] = 'pdf|rar|zip';
        $config['max_size'] = '10000';
        $config['file_name'] = 'FinalExam' . time();

        $this->load->library('upload', $config);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('user/uploadFinalExam', $data);
            $this->load->view('templates/v_footer');
        } else {
            if ($this->upload->do_upload('finalexam_file')) {
                $final = $this->upload->data();
                    unlink('./exam/answer/' . $this->input->post('old_ans', TRUE));
                $finalexam = $final['file_name'];
            } else {
                $finalexam = $this->input->post('old_ans', TRUE);
            }
            $data = [
                'user_id' => $this->input->post('id', true),
                'email' => $this->input->post('email', true),
                'finalexam_file' => $finalexam
            ];
            $this->User_model->updateExamFile($data, ['user_id' => $this->input->post('id')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jawaban Anda Berhasil diunggah!</div>');

            redirect('user/v_exam');
        }
    }

    public function uploadRemedialExam()
    {
        $data['title'] = 'Upload Jawaban Remedial Test';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['users'] = $this->db->get_where('user_exam_upload', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('id', 'User ID', 'required', ['required' => "User ID harus diisi!"]);
        // $this->form_validation->set_rules('name', 'Name', 'required', ['required' => "Name harus diisi!"]);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './exam/answer/';
        $config['allowed_types'] = 'pdf|rar|zip';
        $config['max_size'] = '10000';
        $config['file_name'] = 'RemedialExam' . time();

        $this->load->library('upload', $config);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('user/uploadremedialexam', $data);
            $this->load->view('templates/v_footer');
        } else {
            if ($this->upload->do_upload('remedialexam_file')) {
                $remedi = $this->upload->data();
                unlink('/exam/answer/' . $this->input->post('old_ans', TRUE));
                $remediexam = $remedi['file_name'];
            } else {
                $remediexam = $this->input->post('old_ans', TRUE);
            }
            $data = [
                'user_id' => $this->input->post('id', true),
                'email' => $this->input->post('email', true),
                'remedialexam_file' => $remediexam
            ];
            $this->User_model->updateExamFile($data, ['user_id' => $this->input->post('id')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jawaban Anda Berhasil diunggah!</div>');
            // $cekData = $this->User_model->getDataById($data['user_id']);

            // if($cekData) {

            // } else {
            //     $this->User_model->insertExamFile($data, ['user_id' => $this->input->post('id')]);
            //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jawaban Anda Berhasil diunggah!</div>');
            // }          
            redirect('user/v_exam');
        }
    }

    public function examScore()
    {
        $data['title'] = 'Nilai Ujian';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['nilai'] = $this->User_model->getExamScoreWhere(['email' => $this->session->userdata('email')])->row_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('user/examscore', $data);
            $this->load->view('templates/v_footer');
        }
    }

}
