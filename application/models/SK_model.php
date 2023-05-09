<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class SK_model extends CI_Model
{

    private $_table = "tbl_surat";

    public $id_surat;
    public $id_klasifikasi;
    public $id_unit;
    public $username;
    public $nomor_surat;
    public $uraian;
    public $tanggal_surat;
    public $tanggal_dipakai;
    public $keterangan;
    public $file_surat;

    public function rules()
    {
        return [
            [
                'field' => 'nomor_surat',
                'label' => 'Nomor Surat',
                'rules' => 'required'
            ],
            [
                'field' => 'id_unit',
                'label' => 'Form Unit Pengolah',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id_surat)
    {
        return $this->db->get_where($this->_table, ["id_surat" => $id_surat])->row();
    }

    public function getSurat()
    {
        $query = "SELECT * FROM tbl_surat";
        return $this->db->query($query)->result_array();
    }

    public function getSKeluar()
    {
        $query = "SELECT `tbl_surat`.*, `tbl_unit`.`nama_unit`, `tbl_klasifikasi`.`nama_klasifikasi`
        FROM `tbl_surat` JOIN `tbl_unit`
        ON `tbl_surat`.`id_unit` = `tbl_unit`.`id_unit` JOIN  `tbl_klasifikasi` ON `tbl_surat`.`id_klasifikasi` = `tbl_klasifikasi`.`id_klasifikasi` 
      ";
        return $this->db->query($query)->result_array();
    }

    public function getUSurat()
    {
        // ambil nilai username pengguna yang sedang login dari session atau cookie
        $username = $_SESSION['username'] ?? $_COOKIE['username'] ?? null;

        $query = "SELECT `tbl_surat`.*, `tbl_unit`.`nama_unit`, `tbl_klasifikasi`.`nama_klasifikasi`
        FROM `tbl_surat` JOIN `tbl_unit`
        ON `tbl_surat`.`id_unit` = `tbl_unit`.`id_unit` JOIN  `tbl_klasifikasi` ON `tbl_surat`.`id_klasifikasi` = `tbl_klasifikasi`.`id_klasifikasi`
        WHERE `tbl_surat`.`username` = '" . $this->db->escape_str($username) . "'"; // tambahkan kondisi WHERE untuk memeriksa nilai kolom username

        return $this->db->query($query)->result_array();
    }

    public function getNS1($saveData = false)
    {
        $query = "SELECT MAX(nomor_surat) AS ns_auto, MAX(tanggal_surat) AS tgl_surat FROM tbl_surat WHERE MONTH(tanggal_surat) = MONTH(NOW()) AND YEAR(tanggal_surat) = YEAR(NOW())";
        $data = $this->db->query($query)->row_array();
        if ($data) {
            $tgl_surat = $data['tgl_surat'];

            if (date('Y-m', strtotime($tgl_surat)) == date('Y-m')) {
                $max_ns = $data['ns_auto'];
                $max_ns2 = (int)substr($max_ns, 1, 3);
                $nscount = $max_ns2 + 1;
            } else {
                $nscount = 1;
                $tgl_surat = date('Y-m-d');
            }
        } else {
            $tgl_surat = date('Y-m-d');
            $nscount = 1;
        }

        $ns_auto = sprintf('%03s', $nscount);
        //echo "nomor_surat: $ns_auto, tanggal_surat: $tgl_surat\n";


        if ($saveData) {
            $this->db->insert('tbl_surat', array('nomor_surat' => $ns_auto, 'tanggal_surat' => $tgl_surat));
        }
        return $ns_auto;
    }

    public function save()
    {
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
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_surat = $post["id_surat"];
        $this->nomor_surat = $post["nomor_surat"];
        $this->username = $post["username"];
        $this->id_klasifikasi = $post["id_klasifikasi"];
        $this->id_unit = $post["id_unit"];
        $this->uraian = $post["uraian"];
        $this->tanggal_surat = $post["tanggal_surat"];
        $this->tanggal_dipakai = $post["tanggal_dipakai"];
        $this->keterangan = $post["keterangan"];
        $this->bulan = $post["bulan"];
        if (!empty($_FILES["file_surat"]["name"])) {
            $this->file_surat = $this->_uploadfile();
        } else {
            $this->file_surat = $post["old_file"];
        }
        $this->db->update($this->_table, $this, array('id_surat' => $post['id_surat']));
    }

    public function delete($id_surat)
    {
        $this->_deletefile($id_surat);
        return $this->db->delete($this->_table, array("id_surat" => $id_surat));
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

        if (!$this->upload->do_upload('file_surat')) {
            $error = array('error' => $this->upload->display_errors()); //associate view variable $error with upload errors
        } else {
            return $this->upload->data("file_name");
        }
    }

    private function _deletefile($id_surat)
    {
        $surat = $this->getById($id_surat);
        $filename = explode(".", $surat->file_surat)[0];
        return array_map('unlink', glob(FCPATH . "upload/berkas/$filename.*"));
    }

    public function view_by_date($date1, $date2)
    {
        //$this->db->where('DATE(tanggal_pengukuran)', $date); // Tambahkan where tanggal nya
        // return $this->db->get('tbl_ternak')->result();// Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter

        $this->db->set('tbl_surat');
        $this->db->from('tbl_surat');
        $this->db->join('tbl_klasifikasi', 'tbl_klasifikasi.id_klasifikasi=tbl_surat.id_klasifikasi');
        $this->db->join('tbl_unit', 'tbl_unit.id_unit=tbl_surat.id_unit');
        $this->db->where('tanggal_surat >=', $date1);
        $this->db->where('tanggal_surat <=', $date2);
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_month($month, $year)
    {
        $this->db->select('*');
        $this->db->from('tbl_surat');
        $this->db->join('tbl_klasifikasi', 'tbl_klasifikasi.id_klasifikasi=tbl_surat.id_klasifikasi');
        $this->db->join('tbl_unit', 'tbl_unit.id_unit=tbl_surat.id_unit');
        $this->db->where('MONTH(tanggal_dipakai)', $month); // Tambahkan where bulan
        $this->db->where('YEAR(tanggal_dipakai)', $year); // Tambahkan where tahun
        return $this->db->get()->result();
    }

    public function view_by_year($year)
    {
        $this->db->select('*');
        $this->db->from('tbl_surat');
        $this->db->join('tbl_klasifikasi', 'tbl_klasifikasi.id_klasifikasi=tbl_surat.id_klasifikasi');
        $this->db->join('tbl_unit', 'tbl_unit.id_unit=tbl_surat.id_unit');
        $this->db->where('YEAR(tanggal_dipakai)', $year); // Tambahkan where tahun
        return $this->db->get()->result();
    }

    public function view_all()
    {
        $this->db->select('*');
        $this->db->from('tbl_surat');
        $this->db->join('tbl_klasifikasi', 'tbl_klasifikasi.id_klasifikasi=tbl_surat.id_klasifikasi');
        $this->db->join('tbl_unit', 'tbl_unit.id_unit=tbl_surat.id_unit');
        $this->db->order_by('tanggal_surat', 'DESC');
        return $this->db->get()->result();
    }

    public function option_tahun()
    {
        $this->db->select('YEAR(tanggal_surat) AS tahun'); // Ambil Tahun dari field tgl
        $this->db->from('tbl_surat'); // select ke tabel transaksi
        $this->db->order_by('YEAR(tanggal_surat)'); // Urutkan berdasarkan tahun secara Ascending (ASC)
        $this->db->group_by('YEAR(tanggal_surat)'); // Group berdasarkan tahun pada field tgl
        return $this->db->get()->result(); // Ambil data pada tabel transaksi sesuai kondisi diatas
    }

    /*public function view_by_name($name)
    {
        $this->db->set('tbl_ternak');
        $this->db->from('tbl_ternak');
        $this->db->where_in('identitas_sementara', $name);
        $query = $this->db->get();
        return $query->result();

       // $this->db->where('NAME(identitas_sementara)', $name); // Tambahkan where bulan
       // return $this->db->get('tbl_ternak')->result(); // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter 
    } */
}
