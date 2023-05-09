<?php defined('BASEPATH') or exit('No direct script access allowed');

class Penerimaan_model extends CI_Model
{
    private $_table = "tbl_penerimaan";

    public $id_penerimaan;    
    public $id_barang;    
    public $tanggal_penerimaan;    
    public $tanggal_pembelian;    
    public $jumlah_penerimaan;    
    public $harga_penerimaan;
    public $nama_toko;    
    public $alamat_toko;    
    public $bukti_penerimaan;     

    public function rules()
    {
        return [
            [
                'field' => 'tanggal_penerimaan',
                'label' => 'Tanggal Penerimaan',
                'rules' => 'required'
            ],
            [
                'field' => 'jumlah_penerimaan',
                'label' => 'Jumlah',
                'rules' => 'required'
            ],
            [
                'field' => 'harga_penerimaan',
                'label' => 'Harga Satuan',
                'rules' => 'required'
            ],
            [
                'field' => 'nama_toko',
                'label' => 'Nama Toko',
                'rules' => 'required'
            ],
           
            
        ];
        
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id_penerimaan)
    {
        return $this->db->get_where($this->_table, ["id_penerimaan" => $id_penerimaan])->row();
    }

    //public function getDPenerimaan()
    //{
      //  $query = "SELECT * FROM tbl_penerimaan";
        //return $this->db->query($query)->result_array();
   // }

    public function getPenerimaan()
    {
        $query = "SELECT `tbl_penerimaan`.*, `tbl_barang`.*, `tbl_jenis_barang`.*
        FROM `tbl_penerimaan` JOIN `tbl_barang` ON `tbl_penerimaan`.`id_barang` = `tbl_barang`.`id_barang` 
        JOIN `tbl_jenis_barang` ON `tbl_barang`.`id_jenis_barang` = `tbl_jenis_barang`.`id_jenis_barang`";
        //var_dump($query);
        //die;
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

    public function save()
    {
        $post = $this->input->post();
        $penerimaan = [
                'id_penerimaan'        => $post["id_penerimaan"],
                'id_barang'            => $post["id_barang"],
                'tanggal_penerimaan'   => $post["tanggal_penerimaan"],
                'tanggal_pembelian'    => $post["tanggal_pembelian"],
                'jumlah_penerimaan'    => $post["jumlah_penerimaan"],
                'harga_penerimaan'     => $post["harga_penerimaan"],
                'nama_toko'            => $post["nama_toko"],
                'alamat_toko'          => $post["alamat_toko"],
                'bukti_penerimaan' => $this->_uploadfile()
        ];
        $b = $this->db->get_where('tbl_barang', ['id_barang' => $post['id_barang']])->row();
        $barang = [
            'stok' => $b->stok + $post["jumlah_penerimaan"],
        ];

        $this->db->trans_start();
        $this->db->insert($this->_table, $penerimaan);
        $this->db->where('id_barang', $post["id_barang"]);
        $this->db->update('tbl_barang', $barang);
        $this->db->trans_complete();
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_barang        = $post["id_barang"];
        $this->id_jenis_barang  = $post["id_jenis_barang"];
        $this->nama_barang      = $post["nama_barang"];
        $this->stok             = $post["stok"];
        $this->satuan           = $post["satuan"];
        if (!empty($_FILES["bukti_penerimaan"]["name"])) {
            $this->bukti_penerimaan = $this->_uploadfile();
        } else {
            $this->bukti_penerimaan = $post["old_file"];
        }
        $this->db->update($this->_table, $this, array('id_barang' => $post['id_barang']));
    }

    public function delete($id_penerimaan)
    {
        //$post = $this->input->post();
        
        $p = $this->db->get_where('tbl_penerimaan', ['id_penerimaan' => $id_penerimaan])->row();
        $b = $this->db->get_where('tbl_barang', ['id_barang' => $p->id_barang])->row();

        $barang = [
            'stok' => $b->stok - $p->jumlah_penerimaan
        ];
        
        $this->db->trans_start();
        $this->db->delete($this->_table, array("id_penerimaan" => $id_penerimaan));
        $this->db->where('id_barang', $p->id_barang);
        $this->db->update('tbl_barang', $barang);
        $this->db->trans_complete();
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

        if (!$this->upload->do_upload('bukti_penerimaan')) {
            $data['error'] = $this->upload->display_errors();
        } else {
            return $this->upload->data("file_name");
        }
    }

    public function getBMasuk()
    {
        $post = $this->input->post();
        $tanggal1 = $post['tanggal1'];
        $tanggal2 = $post['tanggal2'];

        $this->db->select('*');
        $this->db->from('tbl_penerimaan');
        $this->db->join('tbl_barang', 'tbl_barang.id_barang=tbl_penerimaan.id_barang');
        $this->db->join('tbl_jenis_barang', 'tbl_jenis_barang.id_jenis_barang=tbl_barang.id_jenis_barang');
        $this->db->where('tanggal_penerimaan >=', $tanggal1);
        $this->db->where('tanggal_penerimaan <=', $tanggal2);
        return $this->db->get()->result_array();
    }
}
