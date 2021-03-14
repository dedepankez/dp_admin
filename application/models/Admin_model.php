<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getuser()
    {

        $query = "SELECT `user`. *,`user_role`.`role`
                    FROM `user` JOIN `user_role`
                    ON `user`.`role_id` = `user_role`.`id`
                                 ";
        return  $this->db->query($query)->result_array();
    }

    public function page_getaccount($limit,$start,$keyword = null)
    {
    $this->db->select('user.*,user_role.role');
    
    $this->db->join('user_role','user.role_id=user_role.id');
        if ($keyword) {
          $this->db->like('name',$keyword);
           $this->db->or_like('email',$keyword);
        }
        
        return  $this->db->get('user',$limit,$start)->result_array();
    }


    function tampil_data_menu(){
        return $this->db->get('user_menu');
    }
    function edit_user($where,$table){		
		return $this->db->get_where($table,$where);
	}
    function edit_sub_menu($where,$table){  
        return $this->db->get_where($table,$where);

    }

	function update_user($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
    function delete_user($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    function delete_menu($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function join_menu($id) {
    $this->db->select('user.*,user_role.role as role');
    $this->db->from('user');
    $this->db->join('user_role','user.role_id=user_role.id');
    $this->db->where('user.id', $id);
    //  $this->db->join('keluarga','mahrom.id_keluarga=keluarga.id_keluarga');
    $query = $this->db->get();
    return $query->result();
    }

    public function get_total_account() {
    
        echo $this->db->count_all('user');
        }
    public function count_auto($table,$where=''){
        if($where){
            $this->db->where($where);
        }
        return $this->db->get($table)->num_rows();
    } 
}
