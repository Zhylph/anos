<?php defined('BASEPATH') or exit('No direct script access allowed');

class Klasifikasi_model extends CI_Model
{
    private $_table = "tbl_klasifikasi";

    public $id_klasifikasi;    
    public $nama_klasifikasi;    

    public function rules()
    {
        return [
            [
                'field' => 'nama_klasifikasi',
                'label' => 'Nama Klasifikasi',
                'rules' => 'required'
            ]
        ];
        
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id_klasifikasi)
    {
        return $this->db->get_where($this->_table, ["id_klasifikasi" => $id_klasifikasi])->row();
    }

    public function getKlasifikasi()
    {
        $query = "SELECT * FROM tbl_klasifikasi";
        return $this->db->query($query)->result_array();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_klasifikasi = $post["id_klasifikasi"];
        $this->nama_klasifikasi = $post["nama_klasifikasi"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_klasifikasi = $post["id_klasifikasi"];
        $this->nama_klasifikasi = $post["nama_klasifikasi"];
        $this->db->update($this->_table, $this, array('id_klasifikasi' => $post['id_klasifikasi']));
    }

    public function delete($id_klasifikasi)
    {
        return $this->db->delete($this->_table, array("id_klasifikasi" => $id_klasifikasi));
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