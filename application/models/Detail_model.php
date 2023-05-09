<?php defined('BASEPATH') or exit('No direct script access allowed');

class Detail_model extends CI_Model
{
    private $_table = "tbl_detail_kelas";

    public $user_id;
    public $kelas_id;



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

    public function getById($iddetail)
    {
        return $this->db->get_where($this->_table, ["id" => $iddetail])->row();
    }

    public function getDK()
    {
        $query = "SELECT * FROM tbl_detail_kelas";
        return $this->db->query($query)->result_array();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->user_id = $post["user_id"];
        $this->kelas_id = $post["kelas_id"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->user_id = $post["user_id"];
        $this->kelas_id = $post["kelas_id"];
        $this->db->update($this->_table, $this, array('id' => $post['id']));
    }

    public function delete($iddetail)
    {
        return $this->db->delete($this->_table, array("id" => $iddetail));
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
    
    public function getDetail()
    {
        $query = "SELECT `tbl_detail_kelas`.*, `tbl_mahasiswa`.`nama_lengkap`, `tbl_kelas`.`nama_kelas`
                  FROM `tbl_detail_kelas` JOIN `tbl_mahasiswa`
                  ON `tbl_detail_kelas`.`user_id` = `tbl_mahasiswa`.`user_id` JOIN  `tbl_kelas` ON `tbl_detail_kelas`.`kelas_id` = `tbl_kelas`.`id` 
                ";
        return $this->db->query($query)->result_array();
    }  

    public function getMhsdt()
    {
        $user_id = $this->session->userdata('user_id');
        $query = "SELECT `tbl_detail_kelas`.*, `tbl_mahasiswa`.*, `tbl_kelas`.*, `tbl_user`.*
            FROM `tbl_detail_kelas` JOIN `tbl_mahasiswa`
            ON `tbl_detail_kelas`.`user_id` = `tbl_mahasiswa`.`user_id` JOIN  `tbl_kelas` ON `tbl_detail_kelas`.`kelas_id` = `tbl_kelas`.`id`  
            JOIN `tbl_user` ON `tbl_detail_kelas`.`user_id` = `tbl_user`.`user_id`
            WHERE tbl_detail_kelas.user_id = $user_id ";
        //var_dump($query);
        //die;
            return $this->db->query($query)->result_array();
            
            
    }
}