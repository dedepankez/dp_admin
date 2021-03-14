<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team_model extends CI_Model
{
    public function page_getteam($limit,$start,$keyword = null)
    {
    $this->db->select('front_team.*');
        if ($keyword) {
          $this->db->like('team',$keyword);
           $this->db->or_like('url',$keyword);
        }
        
        return  $this->db->get('front_team',$limit,$start)->result_array();
    }
    public function front_team(){
        $this->db->select('front_team.*



            ');
        

        $this->db->from('front_team'); 
        
        return $this->db->get()->row_array();

    }

    function tampil_data_team(){
        return $this->db->get('front_team');
    }
    function edit_team($where,$table){  
        return $this->db->get_where($table,$where);

    }

	function update_team($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
    function delete_team($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    
    public function join_team($id) {
    $this->db->select('user.*,user_role.role as role');
    $this->db->from('user');
    $this->db->join('user_role','user.role_id=user_role.id');
    $this->db->where('user.id', $id);
    //  $this->db->join('keluarga','mahrom.id_keluarga=keluarga.id_keluarga');
    $query = $this->db->get();
    return $query->result();
    }

    public function get_total_team() {
    
        echo $this->db->count_all('front_team');
        }
    public function count_auto($table,$where=''){
        if($where){
            $this->db->where($where);
        }
        return $this->db->get($table)->num_rows();
    } 

    public function getSuratMasuk($id = false)
    {
        if ($id == false) {
            $this->db->order_by('sort', 'ASC');
            return $this->db->get('user_sub_menu')->result_array();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('user_sub_menu')->row_array();
        }
    }
}
