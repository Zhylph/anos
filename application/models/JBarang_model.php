<?php defined('BASEPATH') or exit('No direct script access allowed');

class JBarang_model extends CI_Model
{
    private $_table = "tbl_jenis_barang";

    public $id_jenis_barang;    
    public $jenis_barang;    

    public function rules()
    {
        return [
            [
                'field' => 'jenis_barang',
                'label' => 'Jenis Barang',
                'rules' => 'required'
            ]
        ];
        
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id_jenis_barang)
    {
        return $this->db->get_where($this->_table, ["id_jenis_barang" => $id_jenis_barang])->row();
    }

    public function getJBarang()
    {
        $query = "SELECT * FROM tbl_jenis_barang";
        return $this->db->query($query)->result_array();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_jenis_barang = $post["id_jenis_barang"];
        $this->jenis_barang = $post["jenis_barang"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_jenis_barang = $post["id_jenis_barang"];
        $this->jenis_barang = $post["jenis_barang"];
        $this->db->update($this->_table, $this, array('id_jenis_barang' => $post['id_jenis_barang']));
    }

    public function delete($id_jenis_barang)
    {
        return $this->db->delete($this->_table, array("id_jenis_barang" => $id_jenis_barang));
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
