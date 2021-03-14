<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    //Memaksa ke controler login jika user iseng menuju url admin
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Site_model', 'st');
    }


    public function index()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Administator';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');
        $data['total'] = $this->admin->count_auto('user');
        $data['totalsub'] = $this->admin->count_auto('user_sub_menu');
        $data['totalmenu'] = $this->admin->count_auto('user_menu');
        $data['totalrole'] = $this->admin->count_auto('user_role');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            New role Added! </div>');
            redirect('admin/role');
        }
    }

    public function edit_role($id){
        $data['config'] = $this->st->site_config();
        $data['title'] = 'role Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $where = array('id' =>$id);
        $this->load->model('Admin_model', 'admin');
        $data['edit'] = $this->admin->edit_user($where,'user_role')->result();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit_role', $data);
            $this->load->view('templates/footer');
        
    }
    public function update_role(){
            $id = $this->input->post('id');
            $role = $this->input->post('role');
            $data  = array(
                'role' => $role );
            $where = array('id'=>$id);
            $this->load->model('Admin_model', 'admin');
            $this->admin->update_user($where,$data,'user_role');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Role Has Been Edit! </div>');
            redirect('admin/role');
    }

    public function delete_role($id){

        $where  = array('id' =>$id );
        $this->load->model('Admin_model', 'admin');
        $this->admin->delete_user($where,'user_role');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
             User Role Has been Delete! </div>');
            redirect('admin/role');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        //mengakali admin agar tidak muncul di role access
        $this->db->where('id !=', 1);
        //tutup ngakalin admin
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['config'] = $this->st->site_config();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Access Changed! </div>');
    }
    public function account()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'User Account';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');
        $data['account'] = $this->db->get('user')->result_array();
        $this->load->library('pagination');

        //ambil data keywoard
        if($this->input->post('submit')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword',$data['keyword']);
        }else{
            $data['keyword'] = $this->session->userdata('keyword');
        }
        //config
        $this->db->like('name',$data['keyword']);
        $this->db->or_like('email',$data['keyword']);
        $this->db->from('user');
        $config['base_url'] = 'http://localhost/dp_admin/admin/account';
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
        $data['account'] = $this->admin->page_getaccount($config['per_page'],$data['start'],$data['keyword']);

       $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email Already Registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match !',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/user_account', $data);
            $this->load->view('templates/footer');
        } else {
            echo 'Data Berhasil Ditambahkan !';
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()

            ];
            $this->db->insert('user', $data);
            // $this->_sendEmail();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation Your Account Has Been Created, Please Login! </div>');
            redirect('admin/account');
        }
    
    }
    public function create_account()
    {
        $data['config'] = $this->st->site_config();
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email Already Registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont match !',
            'min_length' => 'password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/user_account', $data);
            $this->load->view('templates/footer');
        } else {
            echo 'Data Berhasil Ditambahkan !';
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()

            ];
            $this->db->insert('user', $data);
            // $this->_sendEmail();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation Your Account Has Been Created, Please Login! </div>');
            redirect('admin/account');
        }
    }
    public function delete_account($id){

        $where  = array('id' =>$id );
        $this->load->model('Admin_model', 'admin');
        $this->admin->delete_user($where,'user');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
             User Has been Delete! </div>');
            redirect('admin/account');
    }
    public function edit_account($id){
        $data['config'] = $this->st->site_config();
        $data['title'] = 'User Management';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');
        $where = array('id' =>$id);
        $data['edit'] = $this->admin->edit_user($where,'user')->result();
        $data['join'] = $this->admin->join_menu($id);
        $data['role'] = $this->db->get('user_role')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/user_account_edit', $data);
            $this->load->view('templates/footer');
        
    }
    public function update_account(){

            $id = $this->input->post('id');
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            $role_id = $this->input->post('role_id');
            //cek jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['upload_path']          = './assets/img/profile';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2000;
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }


                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $data  = array(
                'name' => $name,
                'role_id' => $role_id );
            $where = array('id'=>$id);
            $this->load->model('Admin_model', 'admin');
            $this->admin->update_user($where,$data,'user');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu Has Been Edit! </div>');
            redirect('admin/account');
        
    }
    public function order_meja()
    {
        $data['title'] = 'Administator';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Ordermeja_model', 'order');
        $data['order'] =$this->order->getorder();
        $data['config'] = $this->st->site_config();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/order_meja', $data);
        $this->load->view('templates/footer');
    }
    public function site_config()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Site Config';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/site_config', $data);
        $this->load->view('templates/footer');
    }
    public function update_site_config(){

            $id = $this->input->post('id');
            $site_title = $this->input->post('site_title');
            $icon_sidebar = $this->input->post('icon_sidebar');
            $theme_sidebar = $this->input->post('theme_sidebar');
            $theme_navbar = $this->input->post('theme_navbar');
            

            $data  = array(
                'site_title' => $site_title,
                'icon_sidebar' => $icon_sidebar,
                'theme_sidebar' => $theme_sidebar,
                'theme_navbar' => $theme_navbar



            );
            $where = array('id'=>$id);
            $this->load->model('Admin_model', 'admin');
            $this->admin->update_user($where,$data,'site_config');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Site_Config Has Been Edit! </div>');
            redirect('admin/site_config');
        
    }

     public function widget_config()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Widget Config';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/widget_config', $data);
        $this->load->view('templates/footer');
    }
    public function update_widget_config(){

            $id = $this->input->post('id');
            $font_color = $this->input->post('font_color');
            $font_color_heading = $this->input->post('font_color_heading');
            $jam_font = $this->input->post('jam_font');
            $jam_theme = $this->input->post('jam_theme');
            
            $data  = array(
                'font_color' => $font_color,
                'font_color_heading' => $font_color_heading,
                'jam_font' => $jam_font,
                'jam_theme' => $jam_theme
            );
            $where = array('id'=>$id);
            $this->load->model('Admin_model', 'admin');
            $this->admin->update_user($where,$data,'site_config');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Widget_Config Has Been Edit! </div>');
            redirect('admin/widget_config');
        
    }


    public function site_config_user()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Site Config User';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/site_config_user', $data);
        $this->load->view('templates/footer');
    }
    public function update_site_config_user(){

            $id = $this->input->post('id');
            $site_title_user = $this->input->post('site_title_user');
            $icon_sidebar_user = $this->input->post('icon_sidebar_user');
            $theme_sidebar_user = $this->input->post('theme_sidebar_user');
            $theme_navbar_user = $this->input->post('theme_navbar_user');
            

            $data  = array(
                'site_title_user' => $site_title_user,
                'icon_sidebar_user' => $icon_sidebar_user,
                'theme_sidebar_user' => $theme_sidebar_user,
                'theme_navbar_user' => $theme_navbar_user



            );
            $where = array('id'=>$id);
            $this->load->model('Admin_model', 'admin');
            $this->admin->update_user($where,$data,'site_config');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Site_Config User Has Been Edit! </div>');
            redirect('admin/site_config_user');
        
    }
    public function widget_config_user()
    {
        $data['config'] = $this->st->site_config();
        $data['title'] = 'Widget Config User';
        $data['user'] = $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();
        $this->load->model('Admin_model', 'admin');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/widget_config_user', $data);
        $this->load->view('templates/footer');
    }
    public function update_widget_config_user(){

            $id = $this->input->post('id');
            $font_color_user = $this->input->post('font_color_user');
            $font_color_heading_user = $this->input->post('font_color_heading_user');
            $jam_font_user = $this->input->post('jam_font_user');
            $jam_theme_user = $this->input->post('jam_theme_user');
            
            $data  = array(
                'font_color_user' => $font_color_user,
                'font_color_heading_user' => $font_color_heading_user,
                'jam_font_user' => $jam_font_user,
                'jam_theme_user' => $jam_theme_user
            );
            $where = array('id'=>$id);
            $this->load->model('Admin_model', 'admin');
            $this->admin->update_user($where,$data,'site_config');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Widget_Config User Has Been Edit! </div>');
            redirect('admin/widget_config_user');
        
    }

}