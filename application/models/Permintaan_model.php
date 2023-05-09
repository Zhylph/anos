<?php defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan_model extends CI_Model
{
    private $_table = "tbl_permintaan";
    //private $_table2 = "tbl_barang";

    public $id_permintaan;    
    public $id_user;    
    public $id_barang;    
    public $jumlah_permintaan;    
    public $tanggal_permintaan;
    public $tanggal_dibutuhkan;    
    public $status_persetujuan;    
    public $jumlah_disetujui;    
    public $tanggal_persetujuan;     
    public $catatan;     
    public $status_penyerahan;     
    public $tanggal_penyerahan;     
    public $bukti;     

    public function rules()
    {
        return [
            [
                'field' => 'jumlah_permintaan',
                'label' => 'Jumlah',
                'rules' => 'required'
            ],
            [
                'field' => 'tanggal_dibutuhkan',
                'label' => 'Tanggal dibutuhkan',
                'rules' => 'required'
            ],
            
        ];
        
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id_permintaan)
    {
        return $this->db->get_where($this->_table, ["id_permintaan" => $id_permintaan])->row();
    }

    //public function getDPenerimaan()
    //{
      //  $query = "SELECT * FROM tbl_penerimaan";
        //return $this->db->query($query)->result_array();
   // }

    public function getPermintaan()
    {
        $query = "SELECT `tbl_permintaan`.*, `tbl_barang`.*, `tbl_jenis_barang`.*, `tbl_user`.*
        FROM `tbl_permintaan` JOIN `tbl_barang` ON `tbl_permintaan`.`id_barang` = `tbl_barang`.`id_barang` 
        JOIN `tbl_jenis_barang` ON `tbl_barang`.`id_jenis_barang` = `tbl_jenis_barang`.`id_jenis_barang`
        JOIN tbl_user ON tbl_permintaan.id_user = tbl_user.id_user";
        
        return $this->db->query($query)->result_array();
    }

    public function getPermintaanS()
    {
        $query = "SELECT `tbl_permintaan`.*, `tbl_barang`.*, `tbl_jenis_barang`.*, `tbl_user`.*
        FROM `tbl_permintaan` JOIN `tbl_barang` ON `tbl_permintaan`.`id_barang` = `tbl_barang`.`id_barang` 
        JOIN `tbl_jenis_barang` ON `tbl_barang`.`id_jenis_barang` = `tbl_jenis_barang`.`id_jenis_barang`
        JOIN tbl_user ON tbl_permintaan.id_user = tbl_user.id_user WHERE tbl_permintaan.status_penyerahan = 'diserahkan'";
        
        return $this->db->query($query)->result_array();
    }

    public function getPermintaanU()
    {
        $data= $this->db->get_where('tbl_user', ['username' => $this->session->userdata('username')])->row();
        $query = "SELECT `tbl_permintaan`.*, `tbl_barang`.*, `tbl_jenis_barang`.*, `tbl_user`.*
        FROM `tbl_permintaan` JOIN `tbl_barang` ON `tbl_permintaan`.`id_barang` = `tbl_barang`.`id_barang` 
        JOIN `tbl_jenis_barang` ON `tbl_barang`.`id_jenis_barang` = `tbl_jenis_barang`.`id_jenis_barang`
        JOIN tbl_user ON tbl_permintaan.id_user = tbl_user.id_user WHERE tbl_permintaan.id_user = $data->id_user ";
      
            return $this->db->query($query)->result_array();
    }
    
    public function getIDPermintaan($id_permintaan)
    {
        $query = "SELECT `tbl_permintaan`.*, `tbl_barang`.*, `tbl_jenis_barang`.*, `tbl_user`.*
        FROM `tbl_permintaan` JOIN `tbl_barang` ON `tbl_permintaan`.`id_barang` = `tbl_barang`.`id_barang` 
        JOIN `tbl_jenis_barang` ON `tbl_barang`.`id_jenis_barang` = `tbl_jenis_barang`.`id_jenis_barang`
        JOIN tbl_user ON tbl_permintaan.id_user = tbl_user.id_user
        WHERE tbl_permintaan.id_permintaan = $id_permintaan ";
        
            return $this->db->query($query)->result_array();
    }

    public function getJBarang()
    {
        $query = "SELECT `tbl_jenis_barang`.*
        FROM `tbl_jenis_barang`";
        //var_dump($query);
        //die;
            return $this->db->query($query)->result_array();
    }

    public function getBarang()
    {
        $query = "SELECT `tbl_barang`.*
        FROM `tbl_barang`";
        //var_dump($query);
        //die;
            return $this->db->query($query)->result_array();
    }

    public function getIDPenerimaan($id_penerimaan)
    {
        $query = "SELECT `tbl_penerimaan`.*, `tbl_barang`.*
        FROM `tbl_penerimaan` JOIN `tbl_barang`
        ON `tbl_penerimaan`.`id_barang` = `tbl_barang`.`id_barang` WHERE id_penerimaan=$id_penerimaan";
        //var_dump($query);
        //die;
            return $this->db->query($query)->result_array();
    }

    public function terimaPermintaan_m()
    {
       
        $post = $this->input->post();
        $permintaan = [
                        'catatan'              => $post['catatan'],
                        'status_persetujuan'   => 'disetujui',
                        'jumlah_disetujui'      => $post['jumlah_disetujui'],
                        'tanggal_persetujuan'  => date("Y-m-d")
                    ];
        $b = $this->db->get_where('tbl_barang', ['id_barang' => $post['id_barang']])->row();
        $barang = [
                        'stok'                 => $b->stok - $post["jumlah_disetujui"]

                ];
        
        //$this->db->update($this->_table, $this, array('id_permintaan' => $post['id_permintaan']));       
        //$this->db->update($this->_table2, $this, array('id_barang' => $post['id_barang']));
        $this->db->trans_start();
        $this->db->where('id_permintaan', $post["id_permintaan"]);
        $this->db->update('tbl_permintaan', $permintaan);
        $this->db->where('id_barang', $post["id_barang"]);
        $this->db->update('tbl_barang', $barang);
        $this->db->trans_complete();

    }

    public function tolakPermintaan_m()
    {
       
        $post = $this->input->post();
        $b = $this->db->get_where('tbl_permintaan', ['id_permintaan' => $post['id_permintaan']])->row();
        $tolak = ['status_persetujuan' => 'ditolak',
                    'jumlah_disetujui' => '0',
                    'catatan' => $post['catatan'],
                    'tanggal_persetujuan' => date("Y-m-d")
                    ];

        $this->db->where('id_permintaan', $post["id_permintaan"]);
        $this->db->update('tbl_permintaan', $tolak);
    }

    public function serahkanPermintaan_m()
    {
        $post = $this->input->post();
        $b = $this->db->get_where('tbl_permintaan', ['id_permintaan' => $post['id_permintaan']])->row();
        $serahkan = ['status_penyerahan' => 'diserahkan',
                    'tanggal_penyerahan' => date("Y-m-d"),
                    'bukti' => $this->_uploadfile()
                ];

        $this->db->where('id_permintaan', $post["id_permintaan"]);
        $this->db->update('tbl_permintaan', $serahkan);
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_permintaan        = $post["id_permintaan"];
        $this->id_user              = $post["id_user"];
        $this->id_barang            = $post["id_barang"];
        $this->tanggal_permintaan   = $post["tanggal_permintaan"];
        $this->tanggal_dibutuhkan   = $post["tanggal_dibutuhkan"];
        $this->jumlah_permintaan    = $post["jumlah_permintaan"];
        $this->status_persetujuan   = $post["status_persetujuan"];
        $this->tanggal_persetujuan  = $post["tanggal_persetujuan"];
        $this->catatan              = $post["catatan"];
        $this->status_penyerahan    = $post["status_penyerahan"];
        $this->tanggal_penyerahan   = $post["tanggal_penyerahan"];
        $this->bukti                = $post["bukti"];

        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_barang        = $post["id_barang"];
        $this->id_jenis_barang  = $post["id_jenis_barang"];
        $this->nama_barang      = $post["nama_barang"];
        $this->stok             = $post["stok"];
        $this->satuan           = $post["satuan"];
        $this->db->update($this->_table, $this, array('id_barang' => $post['id_barang']));
    }

    private function _uploadfile()
    {
        $this->load->helper('inflector');
        $file_name = underscore($_FILES['file_var_name']['name']);
        $config['upload_path']          = './upload/berkas';
        $config['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config['file_name']            = $file_name;
        $config['overwrite']            = true;
        $config['max_size']             = 2048; 
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('bukti')) {
            $data['error'] = $this->upload->display_errors();
        } else {
            return $this->upload->data("file_name");
        }
    }
    public function delete($id_permintaan)
    {
        return $this->db->delete($this->_table, array("id_permintaan" => $id_permintaan));
    }

    public function getBKeluar()
    {
        $post = $this->input->post();
        $tanggal1 = $post['tanggal1'];
        $tanggal2 = $post['tanggal2'];

        $this->db->select('*');
        $this->db->from('tbl_permintaan');
        $this->db->join('tbl_barang', 'tbl_barang.id_barang=tbl_permintaan.id_barang');
        $this->db->join('tbl_jenis_barang', 'tbl_jenis_barang.id_jenis_barang=tbl_barang.id_jenis_barang');
        $this->db->join('tbl_user', 'tbl_user.id_user=tbl_permintaan.id_user');
        $this->db->where('tanggal_permintaan >=', $tanggal1);
        $this->db->where('tanggal_permintaan <=', $tanggal2);
        $this->db->where('status_penyerahan =', 'diserahkan');
        return $this->db->get()->result_array();
    }
}

