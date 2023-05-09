<?php defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    private $_table = "tbl_barang";

    public $id_barang;    
    public $id_jenis_barang;    
    public $nama_barang;    
    public $stok;    
    public $satuan;    

    public function rules()
    {
        return [
            [
                'field' => 'nama_barang',
                'label' => 'Nama Barang',
                'rules' => 'required'
            ],
            [
                'field' => 'stok',
                'label' => 'Stok Barang',
                'rules' => 'required'
            ],
            [
                'field' => 'satuan',
                'label' => 'Satuan Barang',
                'rules' => 'required'
            ],
            
        ];
        
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id_barang)
    {
        return $this->db->get_where($this->_table, ["id_barang" => $id_barang])->row();
    }

    public function getBarang()
    {
        $query = "SELECT * FROM tbl_barang";
        return $this->db->query($query)->result_array();
    }

    public function getDBarang()
    {
        $query = "SELECT `tbl_barang`.*, `tbl_jenis_barang`.*
            FROM `tbl_jenis_barang` JOIN `tbl_barang`
            ON `tbl_jenis_barang`.`id_jenis_barang` = `tbl_barang`.`id_jenis_barang`";
        //var_dump($query);
        //die;
            return $this->db->query($query)->result_array();
    }

    public function getIDBarang($id_barang)
    {
        $query = "SELECT `tbl_barang`.*, `tbl_jenis_barang`.*
            FROM `tbl_jenis_barang` JOIN `tbl_barang`
            ON `tbl_jenis_barang`.`id_jenis_barang` = `tbl_barang`.`id_jenis_barang` WHERE id_barang=$id_barang";
        //var_dump($query);
        //die;
            return $this->db->query($query)->result_array();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_barang        = $post["id_barang"];
        $this->id_jenis_barang  = $post["id_jenis_barang"];
        $this->nama_barang      = $post["nama_barang"];
        $this->stok             = $post["stok"];
        $this->satuan           = $post["satuan"];
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

    public function delete($id_barang)
    {
        return $this->db->delete($this->_table, array("id_barang" => $id_barang));
    }

    private function _uploadfile()
    {
        $this->load->helper('inflector');
        $file_name = underscore($_FILES['file_var_name']['name']);
        $config['upload_path']          = './assets/img/profile';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['file_name']            = $file_name;
        $config['overwrite']            = true;
        $config['max_size']             = 2048; 
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $data['error'] = $this->upload->display_errors();
        } else {
            return $this->upload->data("file_name");
        }
    }
}
