<?php defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{
    private $_table = "tbl_mahasiswa";

    public $user_id;
    public $nama_lengkap;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $alamat;
    public $no_telp;



    public function rules()
    {
        return [
            [
                'field' => 'user_id',
                'label' => 'User ID',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($idmhs)
    {
        return $this->db->get_where($this->_table, ["id" => $idmhs])->row();
    }

    public function getMhs()
    {
        $query = "SELECT * FROM tbl_mahasiswa";
        return $this->db->query($query)->result_array();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->user_id = $post["user_id"];
        $this->nama_lengkap = $post["nama_lengkap"];
        $this->tempat_lahir = $post["tempat_lahir"];
        $this->tanggal_lahir = $post["tanggal_lahir"];
        $this->alamat = $post["alamat"];
        $this->no_telp = $post["no_telp"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->user_id = $post["user_id"];
        $this->nama_lengkap = $post["nama_lengkap"];
        $this->tempat_lahir = $post["tempat_lahir"];
        $this->tanggal_lahir = $post["tanggal_lahir"];
        $this->alamat = $post["alamat"];
        $this->no_telp = $post["no_telp"];
        $this->db->update($this->_table, $this, array('id' => $post['id']));
    }

    public function delete($idmhs)
    {
        return $this->db->delete($this->_table, array("id" => $idmhs));
    }

    private function _uploadfile()
    {
        $this->load->helper('inflector');
        $file_name = underscore($_FILES['file_var_name']['name']);
        $config['upload_path']          = './assets/img/';
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
