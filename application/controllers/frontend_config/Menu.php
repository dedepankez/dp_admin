<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('front_config/Menu_model', 'menu');
        $this->load->model('Site_model','st');
        $this->load->library('pagination');
    }

public function index()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Front Menu';
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
        $this->db->like('menu',$data['keyword']);
        $this->db->or_like('url',$data['keyword']);
        $this->db->from('front_menu');
        $config['base_url'] = 'http://localhost/dp_admin/frontend_config/menu/index';
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
        $data['menu'] = $this->menu->page_getmenu($config['per_page'],$data['start'],$data['keyword']);
   
        $this->template->render_page('frontend_config/menu/index', $data);
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {

            $this->template->render_page('frontend_config/menu/index',$data);
        } else {
            $this->db->insert('front_menu', [
                'menu' => $this->input->post('menu'),
                'url' => $this->input->post('url'),
                'status' => $this->input->post('status'),
                'sort' => $this->input->post('sort')

        ]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Front Menu Added! </div>');
            redirect('frontend_config/menu/index');
        }    
        
    }

    public function edit($id){
        $data['config'] = $this->st->site_config();
        $data['title'] = 'EDIT FRONT MENU';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['menu'] = $this->menu->edit_menu($where,'front_menu')->row_array();
            $this->template->render_page('frontend_config/menu/edit', $data);
        
    }
     public function update(){
            $id = $this->input->post('id');
            $menu = $this->input->post('menu');
            $url = $this->input->post('url');
            $status = $this->input->post('status');
            $sort = $this->input->post('sort');
            
            
            $data  = array(
                'menu'=>$menu,
                'url'=>$url,
                'status'=>$status,
                'sort'=>$sort
                 );
            $where = array
            (
                'id'=>$id
                
                
        );
            $this->menu->update_menu($where,$data,'front_menu');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu Has Been Edit! </div>');
            redirect('frontend_config/menu/index');
    }

    public function delete($id){

        $where  = array('id' =>$id );
        $this->menu->delete_menu($where,'front_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
             Front Menu Has been Delete! </div>');
            redirect('frontend_config/menu/index');
    }
}