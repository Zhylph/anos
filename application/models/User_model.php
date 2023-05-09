<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "tbl_user";

    public $id_user;    
    public $nama_user;    
    public $bidang;    
    public $username;
    public $password;
    public $id_role;

    public function rules()
    {
        return [
            [
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
            ]
        ];
        
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($iduser)
    {
        return $this->db->get_where($this->_table, ["id_user" => $iduser])->row();
    }

    public function getUser()
    {
        $query = "SELECT * FROM tbl_user WHERE id_role = '0'
                ";
        return $this->db->query($query)->result_array();
    }

    public function getTbuser()
    {
        $query = "SELECT `tbl_user`.*, `user_role`.*
            FROM `tbl_user` JOIN `user_role`
            ON `user_role`.`id` = `tbl_user`.`id_role` WHERE tbl_user.id_role = '1' OR tbl_user.id_role = '2' OR tbl_user.id_role = '3'   ";
        //var_dump($query);
        //die;
            return $this->db->query($query)->result_array();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_user = $post["id_user"];
        $this->nama_user = $post["nama_user"];
        $this->bidang = $post["bidang"];
        $this->username = $post["username"];
        $this->password = password_hash($post["password"], PASSWORD_DEFAULT);
        $this->id_role = $post["id_role"];
        $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id_user = $post["id_user"];
        $this->nama_user = $post["nama_user"];
        $this->bidang = $post["bidang"];
        $this->username = $post["username"];
        $this->password = password_hash($post["password"], PASSWORD_DEFAULT);
        $this->id_role = $post["id_role"];
        $this->db->update($this->_table, $this, array('id_user' => $post['id_user']));
    }

    public function delete($iduser)
    {
        return $this->db->delete($this->_table, array("id_user" => $iduser));
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
