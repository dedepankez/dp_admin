<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quote extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('front_config/Menu_model', 'menu');
        $this->load->model('Site_model','st');
        $this->load->model('Front_model','fm');
    }

    public function index(){
        $data['config'] = $this->st->site_config();
        $data['quote'] = $this->fm->front_quote();
        $data['title'] = 'Front Quote';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->template->render_page('frontend_config/quote/edit', $data);
        
    }
     public function update(){
            $id = $this->input->post('id');
            $misi = $this->input->post('misi');
            $visi = $this->input->post('visi');
            $motto = $this->input->post('motto');
            
            
            
            $data  = array(
                'visi'=>$visi,
                'misi'=>$misi,
                'motto'=>$motto
                 );
            $where = array
            (
                'id'=>$id
                
                
        );
            $this->menu->update_menu($where,$data,'front_quote');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Quote Has Been Edit! </div>');
            redirect('frontend_config/quote/index');
    }
}