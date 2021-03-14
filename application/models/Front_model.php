<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Front_Model extends CI_Model
{
     
    public function front_config(){
        $this->db->select('front_config.*



            ');
        

        $this->db->from('front_config'); 
        
        return $this->db->get()->row_array();

    }

    public function front_quote(){
        $this->db->select('front_quote.*



            ');
        

        $this->db->from('front_quote'); 
        
        return $this->db->get()->row_array();

    }

    public function front_slider(){
        $this->db->select('front_slider.*



            ');
        

        $this->db->from('front_slider'); 
        
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

    public function front_sosmed()
    {

        $this->db->select('front_sosmed.*

            ');
        
        $this->db->where('status',0);
        $this->db->from('front_sosmed'); 
        
        return $this->db->get()->result_array();
    }

    public function front_team()
    {

        $this->db->select('front_team.*

            ');
        
        $this->db->from('front_team'); 
        
        return $this->db->get()->result_array();
    }

    public function front_blog()
    {

        $this->db->select('front_blog.*

            ');
        
        $this->db->from('front_blog'); 
        
        return $this->db->get()->result_array();
    }

    public function front_kategori()
    {

        $this->db->select('front_kategori.*

            ');
        
        $this->db->from('front_kategori'); 
        
        return $this->db->get()->result_array();
    }

    function update_front($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
}