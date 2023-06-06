<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Admin extends CI_Controller
{

    private $dompdf;
    // Mencegah masuk controller tanpa session
    public function __construct()
    {
        parent::__construct();
        is_logged_in(); //function helper
        $this->load->library('dompdf_lib');
        $this->dompdf = new Dompdf();
    }

    public function deleteUser()
    {
        $this->load->model('Admin_model', 'dashboard');
        $where = ['id' => $this->uri->segment(3)];
        $this->dashboard->deleteUser($where);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> <i class="fa fa-info-circle"></i> User Berhasil Dihapus!</div>');
        redirect('admin');
    }
    public function deleteMember()
    {
        $this->load->model('Admin_model', 'dashboard');
        $where = ['id' => $this->uri->segment(3)];
        $this->dashboard->deleteUser($where);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> <i class="fa fa-info-circle"></i> Peserta Berhasil Dihapus!</div>');
        redirect('admin/member');
    }
    public function deleteInstructor()
    {
        $this->load->model('Admin_model', 'dashboard');
        $where = ['id' => $this->uri->segment(3)];
        $this->dashboard->deleteUser($where);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> <i class="fa fa-info-circle"></i> Instruktur Berhasil Dihapus!</div>');
        redirect('admin/instructor');
    }

    public function verifyUser()
    {
        $data['peserta'] = $this->User_model->data_peserta();
        if ($peserta['verified'] == 0) {
            $user_ver = $this->uri->segment(3);
            $this->db->query("UPDATE user SET user.verified=user.verified+1 WHERE user.id=$user_ver");
            $this->db->query("INSERT INTO user_exam_upload (user_id, name, email) SELECT id, name, email FROM user WHERE user.id=$user_ver");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> <i class="fa fa-info-circle"></i> Peserta Berhasil Diverifikasi!</div>');

            redirect('admin');
        } else {
            echo "<i class=' badge badge-danger' style='color:red'> Sudah Terverifikasi</i>";
        }
    }

    public function unverifyUser()
    {
        $this->User_model->data_peserta();
        $user_ver = $this->uri->segment(3);
        $this->db->query("UPDATE user SET user.verified=user.verified-1 WHERE user.id=$user_ver");
        $this->db->query("DELETE FROM user_exam_upload WHERE user_id=$user_ver");
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> <i class="fa fa-info-circle"></i> Peserta Berhasil Dikembalikan!</div>');
        redirect('admin/member');
    }


    public function editUser()
    {
        $data['title'] = 'Ubah Data Peserta';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();


        $data['user_ed'] = $this->Admin_model->getUserWhere(['id' => $this->uri->segment(3)])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required');
        // $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|numeric|regex_match[/^\d{10,13}$/]');
        // $this->form_validation->set_rules('domisili', 'Domisili', 'required');

        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '2048';
        $config['upload_path']   = './assets/images/profile/';
        $config['file_name']     = time();
        $this->load->library('upload', $config);

        $name = $this->input->post('name');
        // $no_hp = $this->input->post('no_hp');
        // $domisili = $this->input->post('domisili');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('admin/edit_user', $data);
            $this->load->view('templates/v_footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $img = $this->upload->data();
                unlink('assets/images/profile/' . $this->input->post('old_img', TRUE));
                $new_img = $img['file_name'];
            } else {
                $new_img = $this->input->post('old_img', TRUE);
            }

            $data = [
                'name' => $name,
                'image' => $new_img,
                // 'no_hp' => $no_hp,
                // 'domisili' => $domisili
            ];
            $this->Admin_model->updateUser($data, ['id' => $this->input->post('id')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Profil Peserta berhasil diubah!</div>');

            redirect('admin/member');
        }
    }

    public function editInstructor()
    {
        $data['title'] = 'Ubah Data Instruktur';
        $data['user'] = $this->User_model->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['ins_ed'] = $this->Admin_model->getUserWhere(['id' => $this->uri->segment(3)])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required');
        // $this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required|numeric|regex_match[/^\d{10,13}$/]');
        // $this->form_validation->set_rules('domisili', 'Domisili', 'required');

        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '2048';
        $config['upload_path']   = './assets/images/profile/';
        $config['file_name']     = time();
        $this->load->library('upload', $config);

        $name = $this->input->post('name');
        // $no_hp = $this->input->post('no_hp');
        // $domisili = $this->input->post('domisili');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('admin/edit_instructor', $data);
            $this->load->view('templates/v_footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $img = $this->upload->data();
                unlink('assets/images/profile/' . $this->input->post('old_img', TRUE));
                $new_img = $img['file_name'];
            } else {
                $new_img = $this->input->post('old_img', TRUE);
            }

            $data = [
                'name' => $name,
                'image' => $new_img,
                // 'no_hp' => $no_hp,
                // 'domisili' => $domisili
            ];
            $this->Admin_model->updateUser($data, ['id' => $this->input->post('id')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Profil Peserta berhasil diubah!</div>');

            redirect('admin/instructor');
        }
    }



    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user_count'] = $this->User_model->jumlah_user();
        $data['user_wait'] = $this->User_model->user_wait();
        $data['user_verified'] = $this->User_model->user_verified();
        $data['instructor'] = $this->User_model->jumlah_instruktur();
        $data['user_peserta'] = $this->User_model->data_peserta();
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/v_footer');
        }
    }

    public function open_bb()
    {
        $bb = $this->Admin_model->get_bb();

        // Tentukan ukuran gambar
        $size = "1920x1080";

        // Buka gambar dalam tab baru
        echo '<script>window.open("' . $bb . '", "_blank").resizeTo(' . $size . ');</script>';
    }
    // Function untuk menampilkan role
    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/v_header', $data);
        $this->load->view('templates/v_sidebar', $data);
        $this->load->view('templates/v_topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/v_footer');
    }

    // Function untuk menampilkan role access user
    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();


        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/v_header', $data);
        $this->load->view('templates/v_sidebar', $data);
        $this->load->view('templates/v_topbar', $data);
        $this->load->view('admin/roleaccess', $data);
        $this->load->view('templates/v_footer');
    }

    // Function untuk merubah hak akses user
    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Access has been changes!</div>');
    }

    public function member()
    {
        $data['title'] = 'Daftar Peserta';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'dashboard');
        $data['dashboard'] = $this->dashboard->getRole();
        $data['user_peserta'] = $this->User_model->data_peserta();
        $data['admin'] = $this->db->get('user')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('admin/member', $data);
            $this->load->view('templates/v_footer');
        }
    }

    public function instructor()
    {
        $data['title'] = 'Daftar Instruktur';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'dashboard');
        $data['dashboard'] = $this->dashboard->getRole();
        $data['user_instruktur'] = $this->Admin_model->data_instruktur();
        $data['admin'] = $this->db->get('user')->result_array();


        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered in our system'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => "Password don't match",
            'min_length' => "Password too short (min. 8 character)"
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('admin/instructor', $data);
            $this->load->view('templates/v_footer');
        } else {

            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 3,
                'buktibayar' => 'nodata.png',
                'verified' => 1,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> User Instruktur Berhasil Dibuat! </div>');
            redirect('admin/instructor');
        }
    }

    public function certificate()
    {
        $data['title'] = 'Sertifikat Peserta';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['certificate'] = $this->Admin_model->getCert()->result_array();
        // $data['score'] = $this->Instructor_model->joinExamScore()->result_array();


        $this->form_validation->set_rules('user_id', 'User ID', 'required', ['required' => 'User ID harus diisi']);
        $this->form_validation->set_rules('name', "Nama Peserta", 'required', ['required' => 'Nama Peserta Harus Diisi']);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('admin/certificate', $data);
            $this->load->view('templates/v_footer');
        } else {
        }
    }

    public function syncCert()
    {
        // tambah data ketabel user_certificate apabila belum ada
        $this->db->query(
            "INSERT IGNORE INTO user_certificate (user_id, name) 
            SELECT user_id, name 
            FROM user_exam_score
            WHERE status_id=1
            AND NOT EXISTS 
            (SELECT * FROM user_certificate 
             WHERE user_certificate.user_id = user_exam_score.user_id 
             AND user_certificate.name = user_exam_score.name);"
        );

        // Hapus data yang tidak ada di tabel user_exam_score dari tabel user_certificate
        $this->db->query('DELETE FROM user_certificate WHERE user_id NOT IN (SELECT user_id FROM user_exam_score);');

        $this->session->set_flashdata('success_message', '<div class="alert alert-success" role="alert"> <i class="fa fa-info-circle"></i> Data Berhasil Disinkronkan!</div>');
        redirect('admin/certificate');
    }

    public function deleteCert($id)
    {
        $where = array('user_id' => $id);
        $this->Admin_model->deleteCert($where, 'user_certificate');
        redirect('admin/certificate');
    }

    public function uploadCert()
    {
        $data['title'] = 'Upload Sertifikat';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['certificate'] = $this->Admin_model->getCertWhere(['user_id' => $this->uri->segment(3)])->result_array();

        $this->form_validation->set_rules('user_id', 'User ID', 'required', ['required' => 'User ID harus diisi']);
        $this->form_validation->set_rules('name', "Nama Peserta", 'required', ['required' => 'Nama Peserta Harus Diisi']);

        //konfigurasi sebelum gambar diupload
        $config['allowed_types']    = 'pdf|rar|zip';
        $config['max_size']         = '10248';
        $config['upload_path']      = './assets/cert/';
        $config['file_name']        = 'Certificate' . time();

        //memuat atau memanggil library upload
        $this->load->library('upload', $config);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('admin/upload_cert', $data);
            $this->load->view('templates/v_footer');
        } else {
            if ($this->upload->do_upload('certificate')) {
                $certificate = $this->upload->data();
                unlink('./assets/cert/' . $this->input->post('old_cert', TRUE));
                $cert = $certificate['file_name'];
            } else {
                $cert = $this->input->post('old_cert', TRUE);
            }
            $data = [
                'user_id' => $this->input->post('user_id', true),
                'name'   => $this->input->post('name', true),
                // 'email'  => $this->input->post('email', true),
                'certificate'  => $cert
            ];

            $this->Admin_model->updateCert($data, ['user_id' => $this->input->post('user_id')]);
            redirect('admin/certificate');
        }
    }

    public function shareCert()
    {
        $query = ("SELECT COUNT(*) as count FROM user_certificate WHERE certificate = ''");
        $result = $this->db->query($query)->row();
        if ($result->count == 0) {
            $this->db->query("UPDATE user SET role_id = 4 WHERE status_id = 1 AND role_id = 2;");
            $this->db->query("UPDATE user_certificate SET cert_created = NOW()");
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> <i class="fa fa-info-circle"></i> Sertifikat Berhasil Dibagikan!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> <i class="fa fa-info-circle"></i> Ada Kolom Sertifikat yang masih Kosong!</div>');
        }
        redirect('admin/certificate');
    }

    public function addInstructor()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered in our system'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => "Password don't match",
            'min_length' => "Password too short (min. 8 character)"
        ]);
        // $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]');
        // $this->form_validation->set_rules('');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('admin/instructor', $data);
            $this->load->view('templates/v_footer');
        } else {

            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 3,
                'buktibayar' => 'nodata.png',
                'verified' => 1,
                'mid_exam' => 'nodata.pdf',
                'final_exam' => 'nodata.pdf',
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> User Instruktur Berhasil Dibuat! </div>');
            redirect('admim/instructor');
        }
    }

    public function alumni()
    {

        $data['title'] = 'Daftar Alumni';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $this->load->model('Admin_model', 'dashboard');
        // $data['dashboard'] = $this->dashboard->getRole();
        $data['alumni'] = $this->Admin_model->data_alumni();
        $data['admin'] = $this->db->get('user')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/v_header', $data);
            $this->load->view('templates/v_sidebar', $data);
            $this->load->view('templates/v_topbar', $data);
            $this->load->view('admin/alumni', $data);
            $this->load->view('templates/v_footer');
        }
    }

    public function printAlumni()
    {
        $data['alumni'] = $this->Admin_model->data_alumni();
        $data['admin'] = $this->db->get('user')->result_array();

        $this->load->view('admin/print_alumni', $data);
    }

    public function ExportPdfAlumni()
    {

        $data['alumni'] = $this->Admin_model->data_alumni();
        //script untukdompdf php versi 5
        //   $this->load->library('dompdf_gen');

        // script untukdompdf php versi 7.1.0 keatas
        $sroot      = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/pelatihan/application/third_party/dompdf/autoload.inc.php";
        $dompdf = new Dompdf();

        $this->load->view('admin/export_pdf_alumni', $data);

        $paper_size  = 'A4'; // ukurankertas
        $orientation = 'landscape'; //tipe format kertaspotraitatau landscape
        $html = $this->output->get_output();

        //script untukdompdf php versi 5
        //   $this->dompdf->set_paper($paper_size, $orientation);
        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Laporan_data_alumni.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan

        // script untukdompdf php versi 7.1.0 keatas
        $dompdf->set_paper($paper_size, $orientation);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream("laporan_data_buku.pdf", array('Attachment' => 0));
    }

    public function exportExcelAlumni()
    {
        $data = array(
            'title' => 'Data Alumni Pelatihan Akuntansi Brevet Pajak A & B',
            'alumni' => $this->Admin_model->data_alumni()
        );
        $this->load->view('admin/export_excel_alumni', $data);
    }
}
