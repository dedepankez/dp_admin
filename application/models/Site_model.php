<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site_Model extends CI_Model
{
     
    public function site_config(){
        $this->db->select('site_config.*



            ');
        

        $this->db->from('site_config'); 
        
        return $this->db->get()->row_array();

    }

    public function front_menu()
    {

        $this->db->select('front_menu.*

            ');
        
        $this->db->where('status',0);
        $this->db->from('front_menu'); 
        
        return $this->db->get()->result_array();
    }
}