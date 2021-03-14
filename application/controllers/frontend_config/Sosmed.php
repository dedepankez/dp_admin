<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sosmed extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('front_config/Sosmed_model', 'sosmed');
        $this->load->model('Site_model','st');
        $this->load->library('pagination');
    }

public function index()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Front Sosmed';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
       
        // load library
        $this->load->library('pagination');

        //ambil data keywoard
        if($this->input->post('submit')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword',$data['keyword']);
        }else{
            $data['keyword'] = $this->session->userdata('keyword');
        }
        //config
        $this->db->like('class',$data['keyword']);
        $this->db->or_like('url',$data['keyword']);
        $this->db->from('front_sosmed');
        $config['base_url'] = 'http://localhost/dp_admin/frontend_config/sosmed/index';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;


        // Styling nomor kanan dan kiri jika mau distyle
        // idupin script ini,, jika datanya banyak
        // $config['num_links'] = 5;

        //styling
        $config['full_tag_open']='<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']='</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open']='<li class="page-item">';
        $config['first_tag_close']='</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open']='<li class="page-item">';
        $config['last_tag_close']='</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open']='<li class="page-item">';
        $config['next_tag_close']='</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open']='<li class="page-item">';
        $config['prev_tag_close']='</li>';

        // styling active
        $config['cur_tag_open']='<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close']='</a></li>';

        // styling no active for digit
        $config['num_tag_open']='<li class="page-item">';
        $config['num_tag_close']='</li>';

        //atribut class
        $config['attributes'] = array('class'=>'page-link');


        ///initialize
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $data['sosmed'] = $this->sosmed->page_getsosmed($config['per_page'],$data['start'],$data['keyword']);
   
        $this->template->render_page('frontend_config/sosmed/index', $data);
            
        
    }

    public function edit($id){
        $data['config'] = $this->st->site_config();
        $data['title'] = 'EDIT FRONT MENU';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['sosmed'] = $this->sosmed->edit_sosmed($where,'front_sosmed')->row_array();
            $this->template->render_page('frontend_config/sosmed/edit', $data);
        
    }
     public function update(){
            $id = $this->input->post('id');
            $class = $this->input->post('class');
            $url = $this->input->post('url');
            $status = $this->input->post('status');
            
            
            
            $data  = array(
                'class'=>$class,
                'url'=>$url,
                'status'=>$status
                 );
            $where = array
            (
                'id'=>$id
        );
            $this->sosmed->update_sosmed($where,$data,'front_sosmed');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Sosmed Has Been Edit! </div>');
            redirect('frontend_config/sosmed/index');
    }
}