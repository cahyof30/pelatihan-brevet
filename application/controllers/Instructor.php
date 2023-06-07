<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Instructor extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }


    public function index()
    {
        $data['title'] = 'Unggah Materi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['course'] = $this->Instructor_model->getCourse();
        $data['materi'] = $this->Instructor_model->joinDisplayMateri();
        $data['material'] = $this->Instructor_model->tampil_materi()->result_array();

        $this->form_validation->set_rules('course_id', 'Course ID', 'required', ['required' => 'Course ID harus diisi!']);
        $this->form_validation->set_rules('title', 'Title', 'required', ['required' => 'Judul Pelatihan harus diisi!']);
        $this->form_validation->set_rules('link', 'Link Pelatihan', 'required|callback_validate_link', ['required' => 'Link Pelatihan harus diisi!']);
        $this->form_validation->set_rules('time', 'Waktu', 'required', ['required' => 'Waktu Pelatihan harus diisi!']);
        $this->form_validation->set_message('validate_link', 'Format link tidak valid. Pastikan anda menggunakan http:// atau https://');

        $config['allowed_types']    = 'pdf';
        $config['max_size']         = '10248';
        $config['upload_path']      = './modul';
        $config['file_name']        = 'Modul' . time();
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('instructor/index', $data);
            $this->load->view('templates/v_footer');
        } else {
            if ($this->upload->do_upload('modul')) {
                $modul = $this->upload->data();
                $new_modul = $modul['file_name'];
            } else {
                $new_modul = '';
            }

            $data = [
                'course_id' => $this->input->post('course_id', true),
                'title'     => $this->input->post('title', true),
                'link'       => $this->input->post('link', true),
                'time'       => $this->input->post('time', true),
                'modul'     => $new_modul
            ];
            $this->Instructor_model->simpanMateri($data);
            redirect('instructor');
        }
    }


    public function validate_link($link)
    {
        // Memeriksa apakah link dimulai dengan http:// atau https://
        if (preg_match('/^(http:\/\/|https:\/\/)/', $link)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validate_link', 'Format link tidak valid.');
            return FALSE;
        }
    }

    public function deleteCourse($id)
    {
        $where = array('id' => $id);
        $this->Instructor_model->deleteMaterial($where, 'user_material');
        redirect('instructor');
    }

    public function editMateri()
    {
        $data['title'] = 'Edit Materi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['materi'] = $this->Instructor_model->getCourseWhere(['id' => $this->uri->segment(3)])->result_array();
        $course = $this->Instructor_model->joinCourse(['user_material.id' => $this->uri->segment(3)])->result_array();

        foreach ($course as $crs) {
            $data['id'] = $crs['course_id'];
            $data['crs'] = $crs['course'];
        }

        $this->form_validation->set_rules('course_id', 'Jenis Pelatihan', 'required', ['required' => 'Jenis Pelatihan harus diisi']);
        $this->form_validation->set_rules('title', 'Judul Materi', 'required|min_length[3]', ['required' => 'Judul Materi harus diisi', 'min_length' => 'Judul Materi terlalu pendek']);
        $this->form_validation->set_rules('link', 'Link Pelatihan', 'required|min_length[3]', ['required' => 'Link Pelatihan harus diisi', 'min_length' => 'Link Pelatihan terlalu pendek']);
        $this->form_validation->set_rules('time', 'Waktu Pelatihan', 'required', ['required' => 'Link Pelatihan harus diisi', 'min_length' => 'Link Pelatihan terlalu pendek']);

        //konfigurasi sebelum gambar diupload
        $config['upload_path']    = './modul/';
        $config['allowed_types']  = 'pdf';
        $config['max_size']       = '10248';
        $config['file_name']      = 'modul' . time();

        //memuat atau memanggil library upload
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('instructor/edit', $data);
            $this->load->view('templates/v_footer');
        } else {
            if ($this->upload->do_upload('modul')) {
                $modul = $this->upload->data();
                unlink('modul/' . $this->input->post('old_mod', TRUE));
                $modul2 = $modul['file_name'];
            } else {
                $modul2 = $this->input->post('old_mod', TRUE);
            }

            $data = [
                'course_id' => $this->input->post('course_id', true),
                'title' => $this->input->post('title', true),
                'link' => $this->input->post('link', true),
                'time' => $this->input->post('time', true),
                'modul' => $modul2
            ];
            $this->Instructor_model->updateMateri($data, ['id' => $this->input->post('id')]);
            redirect('instructor');
        }
    }

    public function exam()
    {
        $data['title'] = 'Unggah Soal Ujian';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['exam'] = $this->Instructor_model->joinExam()->result_array();


        $this->form_validation->set_rules('course_id', 'Jenis Pelatihan', 'required', ['required' => 'Jenis Pelatihan harus diisi!']);
        $this->form_validation->set_rules('exam_tp', "Jenis Ujian", 'required', ['required' => 'Jenis Ujian harus diisi']);
        $this->form_validation->set_rules('deadline', 'Deadline', 'required', ['required' => 'Deadline harus diisi']);

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './exam/task/';
        $config['allowed_types'] = 'pdf|rar|zip';
        $config['max_size'] = '10248';
        $config['file_name'] = 'task' . time();

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('instructor/exam', $data);
            $this->load->view('templates/v_footer');
        } else {
            if ($this->upload->do_upload('exam_file')) {
                $exam_file = $this->upload->data();
                $task = $exam_file['file_name'];
            } else {
                $task = '';
            }

            $data = [
                'course_id' => $this->input->post('course_id', true),
                'exam_tp'   => $this->input->post('exam_tp', true),
                'deadline'  => $this->input->post('deadline', true),
                'exam_file' => $task

            ];
            $this->Instructor_model->simpanExam($data);
            redirect('instructor/exam');
        }
    }

    public function editExam()
    {
        $data['title'] = 'Edit Ujian';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['exam'] = $this->Instructor_model->getExamWhere(['id' => $this->uri->segment(3)])->result_array();
        $examtype = $this->Instructor_model->joinExamType(['user_exam.id' => $this->uri->segment(3)])->result_array();
        $course = $this->Instructor_model->joinExamCourse(['user_exam.id' => $this->uri->segment(3)])->result_array();

        foreach ($course as $crs) {
            $data['id'] = $crs['course_id'];
            $data['crs'] = $crs['course'];
        }

        foreach ($examtype as $ext) {
            $data['id'] = $ext['exam_tp'];
            $data['ext'] = $ext['exam_name'];
        }

        $data['examtype'] = $this->Instructor_model->getExamType()->result_array();
        $data['course'] = $this->Instructor_model->getCourse()->result_array();


        $this->form_validation->set_rules('course_id', 'Jenis Pelatihan', 'required', ['required' => 'Jenis Pelatihan harus diisi!']);
        $this->form_validation->set_rules('exam_tp', "Jenis Ujian", 'required', ['required' => 'Jenis Ujian harus diisi']);
        $this->form_validation->set_rules('deadline', 'Deadline', 'required', ['required' => 'Deadline harus diisi']);

        //konfigurasi sebelum gambar diupload
        $config['allowed_types']    = 'pdf|rar|zip';
        $config['max_size']         = '10248';
        $config['upload_path']      = './exam/task/';
        $config['file_name']        = 'task' . time();

        //memuat atau memanggil library upload
        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('instructor/editExam', $data);
            $this->load->view('templates/v_footer');
        } else {
            if ($this->upload->do_upload('exam_file')) {
                $exam_file = $this->upload->data();
                unlink('./exam/task/' . $this->input->post('old_task', TRUE));
                $task = $exam_file['file_name'];
            } else {
                $task = $this->input->post('old_task', TRUE);
            }

            $data = [
                'course_id' => $this->input->post('course_id', true),
                'exam_tp'   => $this->input->post('exam_tp', true),
                'deadline'  => $this->input->post('deadline', true),
                'exam_file' => $task

            ];
            $this->Instructor_model->updateExam($data, ['id' => $this->input->post('id')]);
            redirect('instructor/exam');
        }
    }

    public function deleteExam($id)
    {
        $where = array('id' => $id);
        $this->Instructor_model->deleteExam($where, 'user_exam');
        redirect('instructor/exam');
    }

    public function examScore()
    {
        $data['title'] = 'Unggah Nilai Ujian';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['score'] = $this->Instructor_model->displayExamScore()->result_array();


        $this->form_validation->set_rules('user_id', 'User ID', 'required', ['required' => 'User ID harus diisi']);
        $this->form_validation->set_rules('name', "Nama Peserta", 'required', ['required' => 'Nama Peserta Harus Diisi']);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('instructor/examscore', $data);
            $this->load->view('templates/v_footer');
        }
    }
    public function deleteExamScore($id)
    {
        $where = array('user_id' => $id);
        $this->Instructor_model->deleteExamScore($where, 'user_exam_score');
        redirect('instructor/examscore');
    }
    public function syncExamScore()
    {
        // tambah data yang belum ada dari tabel user ke tabel user_exam_score
        $this->db->query(
            "INSERT IGNORE INTO user_exam_score (user_id, name, email) 
        SELECT id, name, email 
        FROM user 
        WHERE role_id=2 AND verified=1
        AND NOT EXISTS 
        (SELECT * FROM user_exam_score 
         WHERE user_exam_score.user_id = user.id 
         AND user_exam_score.name = user.name
         AND user_exam_score.email = user.email);"
        );
        // hapus data dari tabel user_exam_score yang tidak ada di tabel user
        $this->db->query('DELETE FROM user_exam_score WHERE user_id NOT IN (SELECT id FROM user WHERE role_id=2);');
        $this->session->set_flashdata('success_message', 'Data berhasil disinkronkan.');
        redirect('instructor/examScore');
    }
    public function editExamScore()
    {
        $data['title'] = 'Edit Nilai Ujian';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['score'] = $this->Instructor_model->getExamScoreWhere(['user_id' => $this->uri->segment(3)])->result_array();
        $status = $this->Instructor_model->displayExamScore(['user_exam_score.user_id' => $this->uri->segment(3)])->result_array();

        // $data['status'] = $this->Instructor_model->getStatus()->result_array();


        $this->form_validation->set_rules('user_id', 'User ID', 'required', ['required' => 'User ID harus diisi']);
        $this->form_validation->set_rules('name', "Nama Peserta", 'required', ['required' => 'Nama Peserta Harus Diisi']);

        $kup_a   = $this->input->post('kup_a', true);
        $pph_op  = $this->input->post('pph_op', true);
        $pph_21  = $this->input->post('pph_21', true);
        $pph_22  = $this->input->post('pph_22', true);
        $ppn     = $this->input->post('ppn', true);
        $pph_b   = $this->input->post('pph_b', true);
        $pbb     = $this->input->post('pbb', true);
        $kup_b   = $this->input->post('kup_b', true);
        $akt_pjk = $this->input->post('akt_pjk', true);

        if ($kup_a < 50 || $pph_op < 50 || $pph_21 < 50 || $pph_22 < 50 || $ppn < 50 || $pph_b < 50 || $pbb < 50 || $kup_b < 50 || $akt_pjk < 50) {
            $statusID = 0;
        } else {
            $statusID = 1;
        }


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('instructor/editExamScore', $data);
            $this->load->view('templates/v_footer');
        } else {
            $data = [
                'user_id'   => $this->input->post('user_id', true),
                'name'      => $this->input->post('name', true),
                'kup_a'    => $kup_a,
                'pph_op'    => $pph_op,
                'pph_21'    => $pph_21,
                'pph_22'    => $pph_22,
                'ppn'       => $ppn,
                'pph_b'     => $pph_b,
                'pbb'       => $pbb,
                'kup_b'     => $kup_b,
                'akt_pjk'   => $akt_pjk,
                'status_id' => $statusID
            ];

            $data2 = [
                'status_id' => $statusID
            ];
            $this->Instructor_model->updateExamScore($data, ['user_id' => $this->input->post('user_id')]);
            $this->Instructor_model->updateRole($data2, ['name' => $this->input->post('name')]);
            redirect('instructor/examScore');
        }
    }

    public function exportExamExcel()
    {
        $data = array(
            'title' => 'Data Nilai Hasil Ujian Pelatihan Akuntansi Brevet Pajak A & B',
            'examresult' => $this->Instructor_model->displayExamScore()->result_array()
        );
        $this->load->view('instructor/export_exam_excel', $data);
    }

    public function exportExamWord()
    {
        $data = array(
            'title' => 'Data Nilai Hasil Ujian Pelatihan Akuntansi Brevet Pajak A & B',
            'examresult' => $this->Instructor_model->displayExamScore()->result_array()
        );
        $this->load->view('instructor/export_exam_word', $data);
    }


    public function examResult()
    {
        $data['title'] = 'Jawaban Ujian';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['result'] = $this->Instructor_model->getExamResult()->result_array();
        $this->form_validation->set_rules('user_id', 'User ID', 'required', ['required' => 'User ID harus diisi']);
        $this->form_validation->set_rules('name', "Nama Peserta", 'required', ['required' => 'Nama Peserta Harus Diisi']);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('instructor/examresult', $data);
            $this->load->view('templates/v_footer');
        } else {
        }
    }

    public function wipeAllData()
    {
        $this->db->query(
            "TRUNCATE TABLE user_exam_upload;"
        );
        $this->session->set_flashdata('success_message', 'Data berhasil dibersihkan.');
        redirect('instructor/examresult');
    }
}
