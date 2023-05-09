<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $this->load->model("Unit_model");
        $this->load->model("Klasifikasi_model");
        $this->load->model("SK_model");
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
        $this->load->view('admin/index', $data);
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

    public function deleteuser($iduser = null)
    {
        if (!isset($iduser)) show_404();

        if ($this->user_model->delete($iduser)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(site_url('admin/user'));
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

    public function unit()
    {
        $data['title'] = 'Nama Unit';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['Unit'] = $this->Unit_model->getUnit();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/unit', $data);
        $this->load->view('templates/footer');
    }

    public function addunit()
    {
        $data['title'] = 'Nama Unit';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $Unit = $this->Unit_model;
        $validation = $this->form_validation;
        $validation->set_rules($Unit->rules());

        if ($validation->run()) {
            $Unit->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/t_unit");
        $this->load->view('templates/footer');
    }

    public function editUnit($id_unit = null)
    {

        $data['title'] = 'Nama Unit';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $Unit = $this->Unit_model;

        $validation = $this->form_validation;
        $validation->set_rules($Unit->rules());

        if ($validation->run()) {
            $Unit->update();
            //var_dump($unit);
            //die;
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/unit');
        }

        $data["Unit"] = $Unit->getById($id_unit);

        if (!$data["Unit"]) show_404();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/e_unit", $data);
        $this->load->view('templates/footer');
    }

    public function deleteUnit($id_unit = null)
    {
        if (!isset($id_unit)) show_404();

        if ($this->Unit_model->delete($id_unit)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(site_url('admin/unit'));
        }
    }

    public function klasifikasi()
    {
        $data['title'] = 'Klasifikasi Surat';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['Klasifikasi'] = $this->Klasifikasi_model->getKlasifikasi();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/klasifikasi', $data);
        $this->load->view('templates/footer');
    }

    public function addklasifikasi()
    {
        $data['title'] = 'Klasifikasi Surat';
        $data['user'] = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

        $Klasifikasi = $this->Klasifikasi_model;
        $validation = $this->form_validation;
        $validation->set_rules($Klasifikasi->rules());

        if ($validation->run()) {
            $Klasifikasi->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            /*var_dump($Klasifikasi);
            die; */
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/t_klasifikasi");
        $this->load->view('templates/footer');
    }

    public function editKlasifikasi($id_klasifikasi = null)
    {

        $data['title'] = 'Klasifikasi Surat';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();

        $Klasifikasi = $this->Klasifikasi_model;

        $validation = $this->form_validation;
        $validation->set_rules($Klasifikasi->rules());

        if ($validation->run()) {
            $Klasifikasi->update();
            //var_dump($unit);
            //die;
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('admin/klasifikasi');
        }

        $data["Klasifikasi"] = $Klasifikasi->getById($id_klasifikasi);

        if (!$data["Klasifikasi"]) show_404();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/e_klasifikasi", $data);
        $this->load->view('templates/footer');
    }

    public function deleteKlasifikasi($id_klasifikasi = null)
    {
        if (!isset($id_klasifikasi)) show_404();

        if ($this->Klasifikasi_model->delete($id_klasifikasi)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(site_url('admin/klasifikasi'));
        }
    }

    public function surat()
    {
        $data['title'] = 'Surat';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['klasifikasi'] = $this->db->get('tbl_klasifikasi')->result_array();
        $data['unit'] = $this->db->get('tbl_unit')->result_array();

        $data['skeluar'] = $this->SK_model->getSKeluar();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/surat', $data);
        $this->load->view('templates/footer');
    }

    public function editsurat($id_surat = null)
    {
        $data['title'] = 'Surat';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['klasifikasi'] = $this->db->get('tbl_klasifikasi')->result_array();
        $data['unit'] = $this->db->get('tbl_unit')->result_array();

        $skeluar = $this->SK_model;
        $validation = $this->form_validation;
        $validation->set_rules($skeluar->rules());

        if ($validation->run()) {
            $skeluar->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('user');
        }

        $data["skeluar"] = $skeluar->getById($id_surat);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/e_surat", $data);
        $this->load->view('templates/footer');
    }

    public function deletesurat($id_surat = null)
    {
        if (!isset($id_surat)) show_404();

        if ($this->SK_model->delete($id_surat)) {
            $this->session->set_flashdata('success', 'Berhasil dihapus');
            redirect(site_url('user'));
        }
    }

    public function addsurat()
    {
        $data['title'] = 'Surat';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['nomor_surat'] = $this->SK_model->getNS1();
        $data['klasifikasi'] = $this->db->get('tbl_klasifikasi')->result_array();
        $data['unit'] = $this->db->get('tbl_unit')->result_array();

        $skeluar = $this->SK_model;
        $validation = $this->form_validation;
        $validation->set_rules($skeluar->rules());

        if ($validation->run()) {
            $nomor_surat = $this->input->post('nomor_surat');
            $skeluar->save($nomor_surat);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('user');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view("admin/t_surat",  $data);
        $this->load->view('templates/footer');
    }

    public function addsurat21()
    {
        $data['title'] = 'Surat';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['nomor_surat'] = $this->SK_model->getNS1();
        $data['klasifikasi'] = $this->db->get('tbl_klasifikasi')->result_array();
        $data['unit'] = $this->db->get('tbl_unit')->result_array();

        $skeluar = $this->SK_model;
        $validation = $this->form_validation;
        $validation->set_rules($skeluar->rules());

        $this->form_validation->set_rules('', '', '');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view("admin/t_surat", $data);
            $this->load->view('templates/footer');
        } else {
            $post = $this->input->post();

            // Ambil nomor surat
            $this->db->select('
                CASE 
                    WHEN COUNT(*) > 0 THEN MAX(nomor_surat) + 1 
                    ELSE 1 
                END AS ns_auto, 
                DATE_FORMAT(NOW(), "%Y-%m-%d") AS tgl_surat
            ', FALSE);
            $this->db->from('tbl_surat');
            $this->db->where('MONTH(tanggal_surat) = MONTH(NOW())');
            $this->db->where('YEAR(tanggal_surat) = YEAR(NOW())');
            $data = $this->db->get()->row();

            // Simpan nomor surat ke dalam variabel
            $ns_count = $data->ns_auto;
            $nomor_surat = sprintf('%03s', $ns_count);
            // Siapkan data untuk disimpan ke dalam database
            $data = array(
                'nomor_surat' => $nomor_surat,
                'username' => $post["username"],
                'id_klasifikasi' => $post["id_klasifikasi"],
                'id_unit' => $post["id_unit"],
                'uraian' => $post["uraian"],
                'tanggal_surat' => $data->tgl_surat,
                'tanggal_dipakai' => $post["tanggal_dipakai"],
                'keterangan' => $post["keterangan"],
                'bulan' => date('m'),
                'file_surat' => $this->_uploadfile(),
            );


            // Simpan data ke dalam tabel
            $this->db->insert('tbl_surat', $data);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect('user');
        }
    }

    private function _uploadfile()
    {

        $this->load->helper('inflector');
        $file_name = underscore($_FILES['file_var_name']['name']);

        $config['upload_path']          = './upload/berkas/';
        $config['allowed_types']        = 'pdf|jpg|docx|doc|jpeg|png';
        $config['file_name']            = $file_name;
        $config['overwrite']            = true;
        $config['max_size']             = 25120; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_name')) {
            echo $this->upload->display_errors(); //associate view variable $error with upload errors
        } else {
            return $this->upload->data("file_name");
        }
    }


    public function cetaksurat()
    {
        $data['title'] = 'Cetak Data Nomor Surat';
        $data['username'] = $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user_role'] = $this->db->get('user_role')->result_array();
        $data['klasifikasi'] = $this->db->get('tbl_klasifikasi')->result_array();
        $data['unit'] = $this->db->get('tbl_unit')->result_array();

        $data['surat'] = $this->SK_model->getSurat();

        if (isset($_GET['filter']) && !empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if ($filter == '1') { // Jika filter nya 1 (per tanggal)
                $tanggal1 = $_GET['tanggal1'];
                $tanggal2 = $_GET['tanggal2'];
                $label = 'Data Tanggal ' . date($tanggal1) . '&nbsp Sampai &nbsp' . date($tanggal2);
                $url_export = 'admin/export?filter=1&tanggal1=' . $tanggal1 . '&tanggal2=' . $tanggal2;
                $Surat = $this->SK_model->view_by_date($tanggal1, $tanggal2); // Panggil fungsi view_by_date yang ada di SK_Model

            } else if ($filter == '2') { // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                $label = 'Data Bulan &nbsp' . $nama_bulan[$bulan] . ' ' . $tahun;
                $url_export = 'admin/export?filter=2&bulan=' . $bulan . '&tahun=' . $tahun;
                $Surat = $this->SK_model->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di SK_Model
            } else if ($filter == '3') { // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                $label = 'Data Tahun &nbsp' . $tahun;
                $url_export = 'admin/export?filter=3&tahun=' . $tahun;
                $Surat = $this->SK_model->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di SK_Model
            }
        } else { // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data';
            $url_export = 'admin/export';
            $Surat = $this->SK_model->view_all(); // Panggil fungsi view_all yang ada di SK_Model
        }
        $data['label'] = $label;
        $data['url_export'] = base_url($url_export);
        $data['Surat'] = $Surat;
        $data['option_tahun'] = $this->SK_model->option_tahun();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/cetaksurat', $data);
        $this->load->view('templates/footer');
    }

    public function export()
    {
        // Load plugin PHPExcel nya
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('IT')
            ->setLastModifiedBy('IT')
            ->setTitle("Data Nomor Surat")
            ->setSubject("Nomor Surat")
            ->setDescription("Laporan Data Nomor Surat")
            ->setKeywords("Data Nomor Surat");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true), // Set font nya jadi bold
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
                'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        if (isset($_GET['filter']) && !empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
            $filter = $_GET['filter']; // Ambil data filder yang dipilih user
            if ($filter == '1') { // Jika filter nya 1 (per tanggal)
                $tanggal1 = $_GET['tanggal1'];
                $tanggal2 = $_GET['tanggal2'];
                $label = 'Data Surat Tanggal ' . date($tanggal1) . date($tanggal2);
                $Surat = $this->SK_model->view_by_date($tanggal1, $tanggal2); // Panggil fungsi view_by_date yang ada di TransaksiModel
            } else if ($filter == '2') { // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                $label = 'Data Surat Bulan ' . $nama_bulan[$bulan] . ' ' . $tahun;
                $Surat = $this->SK_model->view_by_month($bulan, $tahun); // Panggil fungsi view_by_month yang ada di TransaksiModel
            } else if ($filter == '3') { // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];
                $label = 'Data Surat Tahun ' . $tahun;
                $Surat = $this->SK_model->view_by_year($tahun); // Panggil fungsi view_by_year yang ada di TransaksiModel
            }
        } else { // Jika user tidak mengklik tombol tampilkan
            $label = 'Semua Data Surat';
            $Surat = $this->SK_model->view_all(); // Panggil fungsi view_all yang ada di TransaksiModel
        }
        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()->setCellValue('A1', "NOMOR SURAT RSUD H. ABDUL AZIZ MARABAHAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:J1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->setCellValue('A2', $label); // Set kolom A2 sesuai dengan yang pada variabel $label
        $excel->getActiveSheet()->mergeCells('A2:J2'); // Set Merge Cell pada kolom A2 sampai E2
        // Buat header tabel nya pada baris ke 4
        $excel->getActiveSheet()->setCellValue('A4', "No");
        $excel->getActiveSheet()->setCellValue('B4', "Nomor Surat");
        $excel->getActiveSheet()->setCellValue('C4', "Kode Klasifikasi");
        $excel->getActiveSheet()->setCellValue('D4', "Unit Pengolah");
        $excel->getActiveSheet()->setCellValue('E4', "Uraian");
        $excel->getActiveSheet()->setCellValue('F4', "Tanggal Surat");
        $excel->getActiveSheet()->setCellValue('G4', "Keterangan");
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);

        // Set height baris ke 1, 2, 3 dan 4
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('5')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('6')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('7')->setRowHeight(20);
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 5
        foreach ($Surat as $data) { // Lakukan looping pada variabel transaksi
            $bulan_romawi = array(
                '01' => 'I',
                '02' => 'II',
                '03' => 'III',
                '04' => 'IV',
                '05' => 'V',
                '06' => 'VI',
                '07' => 'VII',
                '08' => 'VIII',
                '09' => 'IX',
                '10' => 'X',
                '11' => 'XI',
                '12' => 'XII'
            );
            $data_array = json_decode(json_encode($data), true);
            $excel->getActiveSheet()->setCellValue('A' . $numrow, $no);
            $excel->getActiveSheet()->setCellValue('B' . $numrow, $data_array['nama_klasifikasi'] . '/' . $data_array['nomor_surat'] . '-' .  $data_array['nama_unit'] . '/RSUD/' . str_replace(array_keys($bulan_romawi), array_values($bulan_romawi), $data_array['bulan'] . '/' . date('y')));
            $excel->getActiveSheet()->setCellValue('C' . $numrow, $data_array['nama_klasifikasi']);
            $excel->getActiveSheet()->setCellValue('D' . $numrow, $data_array['nama_unit']);
            $excel->getActiveSheet()->setCellValue('E' . $numrow, $data_array['uraian']);
            $excel->getActiveSheet()->setCellValue('F' . $numrow, date('d F Y', strtotime($data_array['tanggal_dipakai'])));
            $excel->getActiveSheet()->setCellValue('G' . $numrow, $data_array['keterangan']);
            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
            $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(8); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        // Set orientasi kertas jadi LANDSCAPE
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet()->setTitle("Nomor Surat");
        $excel->getActiveSheet();
        // Proses file excel
        ob_end_clean();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Ternak.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
}
