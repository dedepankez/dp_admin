<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    public function getSubMenu()
    {

        $query = "SELECT `user_sub_menu`. *,`user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                 ";
        return  $this->db->query($query)->result_array();
    }

    public function page_getSubMenu($limit,$start,$keyword = null)
    {
        if ($keyword) {
          $this->db->like('title',$keyword);
           $this->db->or_like('sort',$keyword);
        }
        
        return  $this->db->get('user_sub_menu',$limit,$start)->result_array();
    }
    

    function tampil_data_menu(){
        return $this->db->get('user_menu');
    }
    function edit_menu($where,$table){		
		return $this->db->get_where($table,$where);
	}
    function edit_sub_menu($where,$table){  
        return $this->db->get_where($table,$where);

    }

	function update_menu($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}
    function delete_sub($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    function delete_menu($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function join_menu($id) {
    $this->db->select('user_sub_menu.*,user_menu.menu as menu');
    $this->db->from('user_sub_menu');
    $this->db->join('user_menu','user_sub_menu.menu_id=user_menu.id');
    $this->db->where('user_sub_menu.id', $id);
    //  $this->db->join('keluarga','mahrom.id_keluarga=keluarga.id_keluarga');
    $query = $this->db->get();
    return $query->result();
    }
    function tampil_data_submenu_paging($limit,$start){
        return $this->db->get('user_sub_menu', $limit, $start);
    }
    function get_mahasiswa_list($limit, $start){
        $query = $this->db->get('mahasiswa', $limit, $start);
        return $query;
    }
    public function getPage(){
        $filter = $this->input->get('user_sub_menu');
        $this->db->like('user_sub_menu',$filter);
        return $this->db->get('user_sub_menu');
    }
    public function getTotalmenu(){
        $filter = $this->input->get('user_sub_menu');
        $this->db->like('user_sub_menu',$filter);
        return $this->db->count_all_result('user_sub_menu');
    }
    public function get_current_page($limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get('user_sub_menu');
        $rows = $query->result();
 
        if ($query->num_rows() > 0) {
            foreach ($rows as $row) {
                $data[] = $row;
            }
             
            return $data;
        }
 
        return false;
    }
     
    public function get_total() {
        return $this->db->count_all('user_sub_menu');
    }
    public function getallsubmenu(){
        $query = "SELECT `user_sub_menu`. *,`user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                 ";
        return $this->db->get('user_sub_menu')->result_array();
    }


// sub menu datatables
    var $column_order = ['title', 'menu', 'url', 'icon', 'is_active']; // Field yang bisa orderable
    var $column_search = ['title', 'url']; // field yang diizin utk pencarian 
    var $order = ['sort' => 'asc']; // default order 

    private function _get_datatables_query()
    {
        
        $this->db->select('user_sub_menu.*,user_menu.menu as menu');
        $this->db->from('user_sub_menu'); // user_sub_menu adalah table
        $this->db->join('user_menu','user_sub_menu.menu_id=user_menu.id');

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('user_sub_menu');
        return $this->db->count_all_results();
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
    public function getAll()
     {
          $this->db->select('*');
          $this->db->from('user_sub_menu');
          $this->db->order_by('id', 'ASC');

          return $this->db->get();
     }
    public function getDataPagination($limit, $offset)
    {
     $this->db->select('*');
     $this->db->from('user_sub_menu');
     $this->db->order_by('id', 'ASC');
     $this->db->limit($limit, $offset);

     return $this->db->get();
    }

}
