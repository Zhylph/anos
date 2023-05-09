<?php error_reporting(0);?> 
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengurus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model("user_model");
        $this->load->model("JBarang_model");
        $this->load->model("Barang_model");
        $this->load->model("Penerimaan_model");
        $this->load->model("Permintaan_model");
        $this->load->database();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pengurus/index', $data);
        $this->load->view('templates/footer');
    }

    public function user()
    {
        $data['title'] = 'Data User';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user_role'] = $this->db->get('user_role')->result_array();

        $data['user'] = $this->user_model->getTbuser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer');
    }

    public function adduser()
    {
        $data['title'] = 'Tambah User';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['user_role'] = $this->db->get('user_role')->result_array();

        $user = $this->user_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run()) {
            $user->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/t_user");
        $this->load->view('templates/footer');
    }

    public function mahasiswa()
    {
        $data['title'] = 'Data Mahasiswa';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data['mahasiswa'] = $this->mahasiswa_model->getMhs();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/mahasiswa', $data);
        $this->load->view('templates/footer');
    }

    public function addmahasiswa()
    {
        $data['title'] = 'Data Mahasiswa';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['tuser'] = $this->db->get('tbl_user')->result_array();

        $mahasiswa = $this->mahasiswa_model;
        $validation = $this->form_validation;
        $validation->set_rules($mahasiswa->rules());

        if ($validation->run()) {
            $mahasiswa->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/mahasiswa');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/t_mahasiswa", $data);
        $this->load->view('templates/footer');
    }

    public function kelas()
    {
        $data['title'] = 'Data Kelas';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data['kelas'] = $this->kelas_model->getKelas();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/kelas', $data);
        $this->load->view('templates/footer');
    }

    public function kelas1()
    {
        $data['title'] = 'Daftar Kelas';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data['kelas1'] = $this->kelas_model->getKelas1();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/kelas1', $data);
        $this->load->view('templates/footer');
    }

    public function kelas2()
    {
        $data['title'] = 'Daftar Kelas';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data['kelas2'] = $this->kelas_model->getKelas2();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/kelas2', $data);
        $this->load->view('templates/footer');
    }

    public function kelas3()
    {
        $data['title'] = 'Daftar Kelas';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data['kelas3'] = $this->kelas_model->getKelas3();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/kelas3', $data);
        $this->load->view('templates/footer');
    }

    public function p_kelas1()
    {
        $data['title'] = 'Data Kelas';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data['kelas1'] = $this->kelas_model->getKelas1();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/p_kelas1', $data);
    }

    public function p_kelas2()
    {
        $data['title'] = 'Data Kelas';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data['kelas2'] = $this->kelas_model->getKelas2();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/p_kelas2', $data);
    }

    public function p_kelas3()
    {
        $data['title'] = 'Data Kelas';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data['kelas3'] = $this->kelas_model->getKelas3();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/p_kelas3', $data);
    }

    public function addkelas()
    {
        $data['title'] = 'Tambah Kelas';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $kelas = $this->kelas_model;
        $validation = $this->form_validation;
        $validation->set_rules($kelas->rules());

        if ($validation->run()) {
            $kelas->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/t_kelas");
        $this->load->view('templates/footer');
    }

    public function detail()
    {
        $data['title'] = 'Data Detail Kelas';
        $data['user'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['sdetail'] = $this->detail_model->getDetail();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/detail', $data);
        $this->load->view('templates/footer');
    }

    public function adddetail()
    {
        $data['title'] = 'Data Detail Kelas';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['tmahasiswa'] = $this->db->get('tbl_mahasiswa')->result_array();
        $data['tkelas'] = $this->db->get('tbl_kelas')->result_array();

        $detail = $this->detail_model;
        $validation = $this->form_validation;
        $validation->set_rules($detail->rules());

        if ($validation->run()) {
            $detail->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/detail');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/t_detail", $data);
        $this->load->view('templates/footer');
    }

    public function daftarkelas()
    {
        $data['title'] = 'Daftar Kelas';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $data['dkelas'] = $this->kelas_model->getKelas();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/daftarkelas', $data);
        $this->load->view('templates/footer');
    }

    public function editUser($iduser = null)
    {
   
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['user_role'] = $this->db->get('user_role')->result_array();

        $usr = $this->user_model;
       
        $validation = $this->form_validation;
        $validation->set_rules($usr->rules());
      
        if ($validation->run()) {
            $usr->update();
            //var_dump($usr);
            //die;
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/user');
        }

        $data["usr"] = $usr->getById($iduser);
       
        if (!$data["usr"]) show_404();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/e_user", $data);
        $this->load->view('templates/footer');
    }

    public function editmahasiswa($idmhs = null)
    {
   
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $mhs = $this->mahasiswa_model;
       
        $validation = $this->form_validation;
        $validation->set_rules($mhs->rules());
      
        if ($validation->run()) {
            $mhs->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/mahasiswa');
        }

        $data["mhs"] = $mhs->getById($idmhs);
       
        if (!$data["mhs"]) show_404();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/e_mahasiswa", $data);
        $this->load->view('templates/footer');
    }

    public function editkelas($idkls = null)
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $kls = $this->kelas_model;
       
        $validation = $this->form_validation;
        $validation->set_rules($kls->rules());
        
        if ($validation->run()) {
            $kls->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/kelas');
        }

        $data["kls"] = $kls->getById($idkls);
        
        if (!$data["kls"]) show_404();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/e_kelas", $data);
        $this->load->view('templates/footer');
    }

    public function editdetail($iddetail = null)
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['tmahasiswa'] = $this->db->get('tbl_mahasiswa')->result_array();
        $data['tkelas'] = $this->db->get('tbl_kelas')->result_array();

        $dtl = $this->detail_model;
       
        $validation = $this->form_validation;
        $validation->set_rules($dtl->rules());
        
        if ($validation->run()) {
            $dtl->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/detail');
        }

        $data["dtl"] = $dtl->getById($iddetail);
        
        if (!$data["dtl"]) show_404();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/e_detail", $data);
        $this->load->view('templates/footer');
    }

    public function deleteuser($iduser = null)
    {
        if (!isset($iduser)) show_404();

        if ($this->user_model->delete($iduser)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(site_url('admin/user'));
        }
    }

    public function deletemahasiswa($idmhs = null)
    {
        if (!isset($idmhs)) show_404();

        if ($this->mahasiswa_model->delete($idmhs)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(site_url('admin/mahasiswa'));
        }
    }

    public function deletekelas($idkelas = null)
    {
        if (!isset($idkelas)) show_404();

        if ($this->kelas_model->delete($idkelas)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(site_url('admin/kelas'));
        }
    }

    public function deletedetail($iddetail = null)
    {
        if (!isset($iddetail)) show_404();

        if ($this->detail_model->delete($iddetail)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(site_url('admin/detail'));
        }
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }


    public function roleAccess($id_role)
    {
        $data['title'] = 'Role Access';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $id_role])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }


    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $id_role = $this->input->post('roleId');

        $data = [
            'id_role' => $id_role,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function jenisbarang()
    {
        $data['title'] = 'Klasifikasi Barang';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['JBarang'] = $this->JBarang_model->getJBarang();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/jenisbarang', $data);
        $this->load->view('templates/footer');
    }

    public function addjbarang()
    {
        $data['title'] = 'Jenis Barang';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $JBarang = $this->JBarang_model;
        $validation = $this->form_validation;
        $validation->set_rules($JBarang->rules());

        if ($validation->run()) {
            $JBarang->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/t_jenis_barang");
        $this->load->view('templates/footer');
    }

    public function editJBarang($id_jenis_barang = null)
    {
   
        $data['title'] = 'Jenis Barang';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $JBarang = $this->JBarang_model;
       
        $validation = $this->form_validation;
        $validation->set_rules($JBarang->rules());
      
        if ($validation->run()) {
            $JBarang->update();
            //var_dump($usr);
            //die;
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/jenisbarang');
        }

        $data["JBarang"] = $JBarang->getById($id_jenis_barang);
       
        if (!$data["JBarang"]) show_404();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/e_jenis_barang", $data);
        $this->load->view('templates/footer');
    }

    public function deletejenisbarang($id_jenis_barang = null)
    {
        if (!isset($id_jenis_barang)) show_404();

        if ($this->JBarang_model->delete($id_jenis_barang)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(site_url('admin/jenisbarang'));
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
        $this->load->view('admin/barang', $data);
        $this->load->view('templates/footer');
    }

    public function addbarang()
    {
        $data['title'] = 'Daftar Barang';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['JBarang'] = $this->db->get('tbl_jenis_barang')->result_array();

        $Barang = $this->Barang_model;
        $validation = $this->form_validation;
        $validation->set_rules($Barang->rules());

        if ($validation->run()) {
            $Barang->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/t_barang");
        $this->load->view('templates/footer');
    }

    public function editbarang($id_barang = null)
    {
   
        $data['title'] = 'Daftar Barang';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['JBarang'] = $this->db->get('tbl_jenis_barang')->result_array();

        $Brg = $this->Barang_model;
        
        $validation = $this->form_validation;
        $validation->set_rules($Brg->rules());
        $Brg->update();

        if ($validation->run()) {
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/barang');
        }

        $data["Brg"] = $Brg->getById($id_barang);
    
        if (!$data["Brg"]) show_404();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/e_barang", $data);
        $this->load->view('templates/footer');
    }

    public function deletebarang($id_barang = null)
    {
        if (!isset($id_barang)) show_404();

        if ($this->Barang_model->delete($id_barang)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(site_url('admin/barang'));
        }
    }

    public function penerimaan()
    {
        $data['title'] = 'Barang Masuk';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['penerimaan'] = $this->Penerimaan_model->getPenerimaan();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/penerimaan', $data);
        $this->load->view('templates/footer');
    }

    public function addpenerimaanORI()
    {
        $data['title'] = 'Data Penerimaan';
        $data['penerimaan'] = $this->Penerimaan_model->getPenerimaan();
        //$data['penerimaan'] = $this->Penerimaan_model->getJBarang();
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['User'] = $this->db->get('tbl_user')->result_array();
        $data['JBarang'] = $this->db->get('tbl_jenis_barang')->result_array();
        $data['Barang'] = $this->db->get('tbl_barang')->result_array();

        $penerimaan = $this->Penerimaan_model;
        $validation = $this->form_validation;
        $validation->set_rules($penerimaan->rules());

        if ($validation->run()) {
            $penerimaan->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/t_penerimaan");
        $this->load->view('templates/footer');
    }

    public function deletepenerimaan($id_penerimaan = null)
    {
        if (!isset($id_penerimaan)) show_404();

        $this->Penerimaan_model->delete($id_penerimaan);
        $this->session->set_flashdata('success', 'Berhasil dihapus');
        redirect(site_url('admin/penerimaan'));
        
    }

    public function permintaan()
    {
        $data['title'] = 'Permintaan Barang';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['permintaan'] = $this->Permintaan_model->getPermintaan();
        //var_dump($data);
        //die;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/permintaan', $data);
        $this->load->view('templates/footer');
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
        $this->load->view("admin/t_permintaan");
        $this->load->view('templates/footer');
    }

    public function addpenerimaan()
    {
        $data['title'] = 'Data Penerimaan';
        $data['penerimaan'] = $this->Penerimaan_model->getPenerimaan();
        //$data['penerimaan'] = $this->Penerimaan_model->getJBarang();
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['User'] = $this->db->get('tbl_user')->result_array();
        $data['JBarang'] = $this->db->get('tbl_jenis_barang')->result_array();
        $data['Barang'] = $this->db->get('tbl_barang')->result_array();
        
        $penerimaan = $this->Penerimaan_model;
        $validation = $this->form_validation;
        $validation->set_rules($penerimaan->rules());

        

        if ($validation->run()) {
            //$id_barang = $this->input->post('id_barang');
            $penerimaan->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/t_penerimaan");
        $this->load->view('templates/footer');
    }

    public function terimaPermintaan()
    {
        $data['permintaan'] = $this->Permintaan_model->getPermintaan();
        //$data['permintaanID'] = $this->Permintaan_model->getIDPermintaan();
        
        $this->Permintaan_model->terimaPermintaan_m();
        $this->session->set_flashdata('success', 'Pengajuan berhasil diterima!');
        redirect('admin/permintaan');
    }

    public function tolakPermintaan()
    {
        $data['permintaan'] = $this->Permintaan_model->getPermintaan();
       
        $this->Permintaan_model->tolakPermintaan_m();
        $this->session->set_flashdata('success', 'Pengajuan sudah ditolak!');
        redirect('admin/permintaan');
    }

    public function serahkanPermintaan()
    {
        $data['permintaan'] = $this->Permintaan_model->getPermintaan();
        
        $this->Permintaan_model->serahkanPermintaan_m();
        $this->session->set_flashdata('success', 'Pengajuan berhasil diserahkan!');
        redirect('admin/permintaan');
    }
}
