<?php error_reporting(0);?> 

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model("detail_model");
        $this->load->model("mahasiswa_model");
        $this->load->model("Permintaan_model");
        $this->load->model("SK_model");
    }

    public function index()
    {
        $data['title'] = 'Nomor Surat';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['klasifikasi'] = $this->db->get('tbl_klasifikasi')->result_array();
        $data['unit'] = $this->db->get('tbl_unit')->result_array();

        $data['skeluar'] = $this->SK_model->getUSurat();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/surat', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user'] = $this->db->get_where('tbl_mahasiswa', ['username' => $this->session->userdata('username')])->row_array();
        
        $this->form_validation->set_rules('username', 'User ID', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $username = $this->input->post('username');
            $nama_lengkap = $this->input->post('nama_lengkap');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tanggal_lahir = $this->input->post('tanggal_lahir');
            $alamat = $this->input->post('alamat');
            $no_telp = $this->input->post('no_telp');

            $this->db->set('username', $username);
            $this->db->set('nama_lengkap', $nama_lengkap);
            $this->db->set('tempat_lahir', $tempat_lahir);
            $this->db->set('tanggal_lahir', $tanggal_lahir);
            $this->db->set('alamat', $alamat);
            $this->db->set('no_telp', $no_telp);
            $this->db->where('username', $username);
            $this->db->update('tbl_mahasiswa');
            
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }


    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('tbl_user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user');
                }
            }
        }
    }

    public function addpermintaan()
    {
        $data['title'] = 'Data Permintaan';
        $data['permintaan'] = $this->Permintaan_model->getPermintaan();
        //$data['permintaan'] = $this->Penerimaan_model->getJBarang();
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        //$data['User'] = $this->db->get('tbl_user')->result_array();
        $data['JBarang'] = $this->db->get('tbl_jenis_barang')->result_array();
        $data['Barang'] = $this->db->get('tbl_barang')->result_array();

        $permintaan = $this->Permintaan_model;
        $validation = $this->form_validation;
        $validation->set_rules($permintaan->rules());

        if ($validation->run()) {
            $permintaan->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("user/t_permintaan");
        $this->load->view('templates/footer');
    }

    public function deletepermintaan($id_permintaan = null)
    {
        if (!isset($id_permintaan)) show_404();

        if ($this->Permintaan_model->delete($id_permintaan)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(site_url('user'));

        }
    }

    public function barang()
    {
        $data['title'] = 'Daftar Barang';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['Barang'] = $this->Barang_model->getDBarang();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/barang', $data);
        $this->load->view('templates/footer');
    }
   
}
