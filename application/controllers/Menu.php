<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    //Memaksa ke controler login
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model');
        $this->load->model('Site_model','st');
        $this->load->library('pagination');
    }
    public function index()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Menu Added! </div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        
        
        //Membuat model Submenu
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();


        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
            $this->load->view('menu/js/submenu_js');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'sort' => $this->input->post('sort'),
                'is_active' => $this->input->post('is_active')

            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New Sub Menu Added! </div>');
            redirect('menu/submenu');
        }
    }

    public function ambilData()
    {
        // jika ada request ajax yang dikirimkan
        if ($this->input->is_ajax_request() == true) {
            // ambil data dari table
            $list = $this->Menu_model->get_datatables();
            $data = [];
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = [];

                // tombol aksi
                $btnAction = "<div class=\"dropdown\">
                    <button class=\"btn btn-sm btn-info dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        <i class=\"fa fa-fw fa-list\"></i>
                    </button>
                    <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                        
                        
                        <a href='edit_sub_menu/$field->id' class='dropdown-item'>Edit</a>
                        <a href=\"\" data-toggle=\"modal\" data-target=\"#modalHapus\" class='dropdown-item' id='hapus-sm' data-id='$field->id'>Hapus</a>
                    </div>
                </div>";

                // Memanggil data dari tabel submenu
                $row[] = $no;
                $row[] = $field->title;
                $row[] = $field->menu ;
                $row[] = $field->url;
                $row[] = $field->icon;
                $row[] = $field->is_active == '1' ? "Yes" : "No";
                $row[] = $btnAction;
                $data[] = $row;
            }

            $output = [
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->Menu_model->count_all(),
                "recordsFiltered" => $this->Menu_model->count_filtered(),
                "data" => $data,
            ];
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function delete_sub_datatables()
    {
        $id = $this->input->post('id');
        $data['surat'] = $this->Menu_model->getSuratMasuk($id);
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('msg', 'dihapus.');
        redirect('menu/submenu');
    }

    public function delete_sub($id){
        $where  = array('id' =>$id );
        $this->Menu_model->delete_sub($where,'user_sub_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
             Menu Has been Delete! </div>');
            redirect('menu/submenu');
    }
    public function delete_menu($id){

        $where  = array('id' =>$id );
        $this->Menu_model->delete_menu($where,'user_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
             Menu Has been Delete! </div>');
            redirect('menu');
    }
    public function edit_menu($id){
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['edit'] = $this->Menu_model->edit_menu($where,'user_menu')->result();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit', $data);
            $this->load->view('templates/footer');
        
    }
    public function update_menu(){
            $id = $this->input->post('id');
            $menu = $this->input->post('menu');
            $data  = array(
                'menu' => $menu );
            $where = array('id'=>$id);
            $this->Menu_model->update_menu($where,$data,'user_menu');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu Has Been Edit! </div>');
            redirect('menu');
    }
    public function edit_sub_menu($id){
        $data['config'] = $this->st->site_config();
        $data['title'] = 'SubMenu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['edit'] = $this->Menu_model->edit_sub_menu($where,'user_sub_menu')->result();
        $data['subMenu'] = $this->Menu_model->join_menu($id);
        $data['menu'] = $this->db->get('user_menu')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_sub_menu', $data);
            $this->load->view('templates/footer');
        
    }
     public function update_sub_menu(){
            $id = $this->input->post('id');
            $menu_id = $this->input->post('menu_id');
            $title = $this->input->post('title');
            $url = $this->input->post('url');
            $icon = $this->input->post('icon');
            $is_active = $this->input->post('is_active');
            
            $data  = array(
                'id'=>$id,
                'menu_id'=>$menu_id,
                'title'=>$title,
                'url'=>$url,
                'icon'=>$icon,
                'is_active'=>$is_active
                 );
            $where = array
            (
                'id'=>$id
                
                
        );
            $this->Menu_model->update_menu($where,$data,'user_sub_menu');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu Has Been Edit! </div>');
            redirect('menu/submenu');
    }
    public function sort()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Sort Menu';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');
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
        $this->db->like('title',$data['keyword']);
        $this->db->or_like('sort',$data['keyword']);
        $this->db->from('user_sub_menu');
        $config['base_url'] = 'http://localhost/dp_admin/menu/sort';
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
        $data['subMenu'] = $this->menu->page_getSubmenu($config['per_page'],$data['start'],$data['keyword']);




            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/sort', $data);
            $this->load->view('templates/footer');
        
    }
    public function edit_sort($id){
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Sort Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $data['edit'] = $this->Menu_model->edit_sub_menu($where,'user_sub_menu')->result();
        $data['subMenu'] = $this->Menu_model->join_menu($id);
        $data['menu'] = $this->db->get('user_menu')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_sort', $data);
            $this->load->view('templates/footer');
        
    }
     public function update_sort(){
            $id = $this->input->post('id');
            
            $sort = $this->input->post('sort');
            
            
            $data  = array(
                'id'=>$id,
                
                'sort'=>$sort
                 );
            $where = array
            (
                'id'=>$id
                
                
        );
            $this->Menu_model->update_menu($where,$data,'user_sub_menu');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu Has Been Edit! </div>');
            redirect('menu/sort');
    }
    
}
