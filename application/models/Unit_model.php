<?php defined('BASEPATH') or exit('No direct script access allowed');

class Unit_model extends CI_Model
{
    private $_table = "tbl_unit";

    public $id_unit;    
    public $nama_unit;    

    public function rules()
    {
        return [
            [
                'field' => 'nama_unit',
                'label' => 'Nama Unit Pengolah',
                'rules' => 'required'
            ]
        ];
        
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id_unit)
    {
        return $this->db->get_where($this->_table, ["id_unit" => $id_unit])->row();
    }

    public function getUnit()
    {
        $query = "SELECT * FROM tbl_unit";
        return $this->db->query($query)->result_array();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_unit = $post["id_unit"];
        $this->nama_unit = $post["nama_unit"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_unit = $post["id_unit"];
        $this->nama_unit = $post["nama_unit"];
        $this->db->update($this->_table, $this, array('id_unit' => $post['id_unit']));
    }

    public function delete($id_unit)
    {
        return $this->db->delete($this->_table, array("id_unit" => $id_unit));
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