<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Klasifikasi extends CI_Controller
{
    //Memaksa ke controler login jika user iseng menuju url admin
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dispo_model', 'sm');
         $this->load->model('Site_model', 'st');
        
    }


    public function index()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Klasifikasi';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['klasifikasi'] = $this->db->get('klasifikasi')->result_array();
        $this->load->library('pagination');

        //ambil data keywoard
        if($this->input->post('submit')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword',$data['keyword']);
        }else{
            $data['keyword'] = $this->session->userdata('keyword');
        }
        //config
        $this->db->like('nama',$data['keyword']);
        $this->db->or_like('kode',$data['keyword']);
        $this->db->from('klasifikasi');
        $config['base_url'] = 'http://localhost/dp_admin/klasifikasi/index';
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
        $data['start'] = $this->uri->segment(3);
        $data['klasifikasi'] = $this->sm->page_getklasifikasi($config['per_page'],$data['start'],$data['keyword']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('klasifikasi/index');
        $this->load->view('templates/footer');
        
    }

    public function tambah(){


        $nama = $this->input->post('nama');
        $kode = $this->input->post('kode');
        $uraian = $this->input->post('uraian');
        $created_at = $this->input->post('created_at');
        $data =array(
            'nama' => $nama,
            'kode' => $kode,
            'uraian' => $uraian,
            'created_at' => $created_at
    );
        $this->db->insert('klasifikasi',$data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Disposisi Telah Ditambahkan! </div>');
       redirect('klasifikasi');

    }
    public function hapus($id){
        $where  = array('id' =>$id );
        $this->load->model('Admin_model', 'admin');
        $this->admin->delete_user($where,'klasifikasi');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
             Data Has been Delete! </div>');
            redirect('klasifikasi');
    }
    public function edit($id){
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Edit Klasifikasi';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');
        $where = array('id' =>$id);
        $data['k'] = $this->admin->edit_user($where,'klasifikasi')->row_array();
        
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('klasifikasi/edit', $data);
            $this->load->view('templates/footer');
        
    }
     public function update(){

            $id = $this->input->post('id');
            $kode = $this->input->post('kode');
            $nama = $this->input->post('nama');
            $uraian = $this->input->post('uraian');
            
            
            $data  = array(
                'nama' => $nama,
                'kode' => $kode,
                'uraian' => $uraian );
            $where = array('id'=>$id);
            
            $this->sm->update_user($where,$data,'klasifikasi');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            KLASIFIKASI Has Been Edit! </div>');
            redirect('klasifikasi');
        
    }
    

    
}