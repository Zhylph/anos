<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
    private $_table = "tbl_kelas";

    public $kode_kelas;
    public $nama_kelas;

    public function rules()
    {
        return [
            [
                'field' => 'kode_kelas',
                'label' => 'ID Kelas',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($idkls)
    {
        return $this->db->get_where($this->_table, ["id" => $idkls])->row();
    }

    public function getKelas()
    {
        $query = "SELECT * FROM tbl_kelas";
        return $this->db->query($query)->result_array();
    }

    public function getKelas1()
    {
        $query = "SELECT `tbl_detail_kelas`.*, `tbl_mahasiswa`.`nama_lengkap`, `tbl_kelas`.*
                  FROM `tbl_detail_kelas` JOIN `tbl_mahasiswa`
                  ON `tbl_detail_kelas`.`user_id` = `tbl_mahasiswa`.`user_id` JOIN  `tbl_kelas` ON `tbl_detail_kelas`.`kelas_id` = `tbl_kelas`.`id` 
                  WHERE tbl_detail_kelas.kelas_id = '1' ";
        return $this->db->query($query)->result_array();
    }  

    public function getKelas2()
    {
        $query = "SELECT `tbl_detail_kelas`.*, `tbl_mahasiswa`.`nama_lengkap`, `tbl_kelas`.*
                  FROM `tbl_detail_kelas` JOIN `tbl_mahasiswa`
                  ON `tbl_detail_kelas`.`user_id` = `tbl_mahasiswa`.`user_id` JOIN  `tbl_kelas` ON `tbl_detail_kelas`.`kelas_id` = `tbl_kelas`.`id` 
                  WHERE tbl_detail_kelas.kelas_id = '2' ";
        return $this->db->query($query)->result_array();
    }  
    
    public function getKelas3()
    {
        $query = "SELECT `tbl_detail_kelas`.*, `tbl_mahasiswa`.`nama_lengkap`, `tbl_kelas`.*
                  FROM `tbl_detail_kelas` JOIN `tbl_mahasiswa`
                  ON `tbl_detail_kelas`.`user_id` = `tbl_mahasiswa`.`user_id` JOIN  `tbl_kelas` ON `tbl_detail_kelas`.`kelas_id` = `tbl_kelas`.`id` 
                  WHERE tbl_detail_kelas.kelas_id = '3' ";
        return $this->db->query($query)->result_array();
    }  

    public function save()
    {
        $post = $this->input->post();
        $this->kode_kelas = $post["kode_kelas"];
        $this->nama_kelas = $post["nama_kelas"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->kode_kelas = $post["kode_kelas"];
        $this->nama_kelas = $post["nama_kelas"];
        $this->db->update($this->_table, $this, array('id' => $post['id']));
    }

    public function delete($idkelas)
    {
        return $this->db->delete($this->_table, array("id" => $idkelas));
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
